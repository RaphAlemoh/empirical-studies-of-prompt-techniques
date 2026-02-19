#!/bin/bash

# Usage:
# ./run_passk.sh CP-01 CP-01-Evaluator.php 1
# ./run_passk.sh CP-01 CP-01-Evaluator.php 10

EXERCISE_ID=$1
EVALUATOR=$2
K=$3

# Timeout per run (seconds)
TIMEOUT_SEC=2

if [ -z "$EXERCISE_ID" ] || [ -z "$EVALUATOR" ] || [ -z "$K" ]; then
  echo "Usage: ./run_passk.sh <EXERCISE_ID> <EVALUATOR.php> <K>"
  exit 1
fi

# ---------- vendor/bin (single known path) ----------
VENDOR_BIN="../../vendor/bin"

# if [ -d "$VENDOR_BIN" ]; then
#   # echo "vendor/bin found at $VENDOR_BIN"
# else
#   echo "vendor/bin NOT found at $VENDOR_BIN"
# fi

PHPMD_BIN="$VENDOR_BIN/phpmd"
PHPCS_BIN="$VENDOR_BIN/phpcs"

MODELS=("codellama" "starcoder2" "mistral")
PROMPTS=("zero" "few_shot" "cot")

RESULTS_DIR="../results"
mkdir -p "$RESULTS_DIR"

CSV_FILE="$RESULTS_DIR/${EXERCISE_ID}_pass@${K}.csv"

# CSV header
if [ ! -f "$CSV_FILE" ]; then
  echo "exercise,model,prompt,k,pass_at_k,valid_runs,passed_runs,total_tests,avg_accuracy,avg_execution_time_ms,avg_memory_kb,avg_cc,avg_loc,avg_psr12_violations" > "$CSV_FILE"
fi

for MODEL in "${MODELS[@]}"; do
  for PROMPT in "${PROMPTS[@]}"; do

    BASE_DIR="../code_extraction/$EXERCISE_ID/$MODEL/$PROMPT"

    PASSED_RUNS=0
    VALID_RUNS=0
    TOTAL_TESTS=0

    ACC_SUM=0
    EXEC_SUM=0
    MEM_SUM=0
    CC_SUM=0
    LOC_SUM=0
    PSR_SUM=0

    for i in $(seq 1 $K); do
      PHP_FILE="$BASE_DIR/${PROMPT}${i}.php"

      [ ! -f "$PHP_FILE" ] && continue

      # ---------- Evaluator execution ----------
      OUT=$(php -d max_execution_time=$TIMEOUT_SEC "$EVALUATOR" "$PHP_FILE" 2>/dev/null)
      [ -z "$OUT" ] && continue

      STATUS=$(php -r '$j=json_decode($argv[1],true); echo $j["status"] ?? "invalid";' "$OUT")
      [ "$STATUS" != "ok" ] && continue

      PASSED=$(php -r '$j=json_decode($argv[1],true); echo $j["passed"];' "$OUT")
      TOTAL=$(php -r '$j=json_decode($argv[1],true); echo $j["total"];' "$OUT")
      ACC=$(php -r '$j=json_decode($argv[1],true); echo $j["accuracy"];' "$OUT")
      EXEC=$(php -r '$j=json_decode($argv[1],true); echo $j["execution_time_ms"];' "$OUT")
      MEM=$(php -r '$j=json_decode($argv[1],true); echo $j["memory_kb"];' "$OUT")

      # ---------- LOC ----------
      LOC=$(wc -l < "$PHP_FILE")

      # ---------- Cyclomatic Complexity ----------
      CC=1
      if [ -x "$PHPMD_BIN" ]; then
        CC=$("$PHPMD_BIN" "$PHP_FILE" text codesize 2>/dev/null \
          | grep -o 'Cyclomatic Complexity.*' \
          | grep -o '[0-9]\+' \
          | head -n1)
        CC=${CC:-1}
      fi

      # ---------- PSR-12 violations ----------
      PSR=0
      if [ -x "$PHPCS_BIN" ]; then
        PSR=$("$PHPCS_BIN" --standard=PSR12 "$PHP_FILE" --report=json 2>/dev/null \
          | php -r '$j=json_decode(stream_get_contents(STDIN),true); echo ($j["totals"]["errors"] ?? 0) + ($j["totals"]["warnings"] ?? 0);')
      fi

      [ "$PASSED" -eq "$TOTAL" ] && PASSED_RUNS=$((PASSED_RUNS + 1))

      TOTAL_TESTS=$TOTAL

      ACC_SUM=$(echo "$ACC_SUM + $ACC" | bc)
      EXEC_SUM=$(echo "$EXEC_SUM + $EXEC" | bc)
      MEM_SUM=$(echo "$MEM_SUM + $MEM" | bc)
      CC_SUM=$((CC_SUM + CC))
      LOC_SUM=$((LOC_SUM + LOC))
      PSR_SUM=$((PSR_SUM + PSR))

      VALID_RUNS=$((VALID_RUNS + 1))
    done

    # ---------- Averages ----------
    if [ "$VALID_RUNS" -gt 0 ]; then
      AVG_ACC=$(echo "scale=4; $ACC_SUM / $VALID_RUNS" | bc)
      AVG_EXEC=$(echo "scale=4; $EXEC_SUM / $VALID_RUNS" | bc)
      AVG_MEM=$(echo "scale=4; $MEM_SUM / $VALID_RUNS" | bc)
      AVG_CC=$((CC_SUM / VALID_RUNS))
      AVG_LOC=$((LOC_SUM / VALID_RUNS))
      AVG_PSR=$((PSR_SUM / VALID_RUNS))
    else
      AVG_ACC=0
      AVG_EXEC=0
      AVG_MEM=0
      AVG_CC=0
      AVG_LOC=0
      AVG_PSR=0
    fi

    PASS_AT_K=$([ "$PASSED_RUNS" -ge 1 ] && echo true || echo false)

    # ---------- Write CSV row ----------
    echo "$EXERCISE_ID,$MODEL,$PROMPT,$K,$PASS_AT_K,$VALID_RUNS,$PASSED_RUNS,$TOTAL_TESTS,$AVG_ACC,$AVG_EXEC,$AVG_MEM,$AVG_CC,$AVG_LOC,$AVG_PSR" >> "$CSV_FILE"

  done
done



# chmod +x run_passk.sh
# ./run_passk.sh CP-01 CP-01-Evaluator.php 1
# ./run_passk.sh CP-01 CP-01-Evaluator.php 10
# ./run_passk.sh CP-02 CP-02-Evaluator.php 1
# ./run_passk.sh CP-02 CP-02-Evaluator.php 10
# ./run_passk.sh CP-03 CP-03-Evaluator.php 1
# ./run_passk.sh CP-03 CP-03-Evaluator.php 10
# ./run_passk.sh CP-04 CP-04-Evaluator.php 1
# ./run_passk.sh CP-04 CP-04-Evaluator.php 10
# ./run_passk.sh CP-05 CP-05-Evaluator.php 1
# ./run_passk.sh CP-05 CP-05-Evaluator.php 10
# ./run_passk.sh CP-06 CP-06-Evaluator.php 1
# ./run_passk.sh CP-06 CP-06-Evaluator.php 10
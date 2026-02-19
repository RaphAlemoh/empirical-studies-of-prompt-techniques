#!/bin/bash

# Usage:
# ./debug10.sh CP-01 CP01Evaluator.php 10

EXERCISE_ID=$1
EVALUATOR=$2
K=$3

# Timeout per run (seconds)
TIMEOUT_SEC=2

if [ -z "$EXERCISE_ID" ] || [ -z "$EVALUATOR" ] || [ -z "$K" ]; then
  echo "Usage: ./debug10.sh <EXERCISE_ID> <EVALUATOR.php> <K>"
  exit 1
fi

# ---------- vendor/bin (single known path) ----------
VENDOR_BIN="../../vendor/bin"

if [ -d "$VENDOR_BIN" ]; then
  echo "vendor/bin found at $VENDOR_BIN"
else
  echo "vendor/bin NOT found at $VENDOR_BIN"
fi

PHPMD_BIN="$VENDOR_BIN/phpmd"
PHPCS_BIN="$VENDOR_BIN/phpcs"

MODELS=("codellama" "starcoder2" "mistral")
PROMPTS=("zero" "few_shot" "cot")

echo "============================================"
echo "EXERCISE : $EXERCISE_ID"
echo "EVALUATOR: $EVALUATOR"
echo "RUNS (k) : $K"
echo "TIMEOUT  : ${TIMEOUT_SEC}s (PHP max_execution_time)"
echo "============================================"
echo

for MODEL in "${MODELS[@]}"; do
  for PROMPT in "${PROMPTS[@]}"; do

    BASE_DIR="../code_extraction/$EXERCISE_ID/$MODEL/$PROMPT"

    echo "MODEL=$MODEL | PROMPT=$PROMPT"
    echo "BASE_DIR=$BASE_DIR"

    PASSED_RUNS=0
    VALID_RUNS=0
    TOTAL_TESTS=0

    ACC_SUM=0
    EXEC_SUM=0
    MEM_SUM=0
    LOC_SUM=0
    CC_SUM=0
    PSR_SUM=0

    for i in $(seq 1 $K); do
      PHP_FILE="$BASE_DIR/${PROMPT}${i}.php"

      echo "    Run #$i : $PHP_FILE"

      if [ ! -f "$PHP_FILE" ]; then
        echo "      File not found"
        continue
      fi

      # ---------- Evaluator execution ----------
      OUT=$(php -d max_execution_time=$TIMEOUT_SEC "$EVALUATOR" "$PHP_FILE" 2>/dev/null)

      if [ -z "$OUT" ]; then
        echo "      Timed out or no output"
        continue
      fi

      STATUS=$(php -r '$j=json_decode($argv[1],true); echo $j["status"] ?? "invalid";' "$OUT")
      echo "      STATUS=$STATUS"

      if [ "$STATUS" != "ok" ]; then
        echo "      Skipping (status=$STATUS)"
        continue
      fi

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
      else
        echo "      phpmd missing or not executable"
      fi

      # ---------- PSR-12 violations ----------
      PSR=0
      if [ -x "$PHPCS_BIN" ]; then
        PSR=$("$PHPCS_BIN" --standard=PSR12 "$PHP_FILE" --report=json 2>/dev/null \
          | php -r '$j=json_decode(stream_get_contents(STDIN),true); echo ($j["totals"]["errors"] ?? 0) + ($j["totals"]["warnings"] ?? 0);')
      else
        echo "      phpcs missing or not executable"
      fi

      echo "      passed=$PASSED / $TOTAL | acc=$ACC% | time=${EXEC}ms | mem=${MEM}KB | loc=$LOC | cc=$CC | psr12=$PSR"

      [ "$PASSED" -eq "$TOTAL" ] && PASSED_RUNS=$((PASSED_RUNS + 1))

      TOTAL_TESTS=$TOTAL

      ACC_SUM=$(echo "$ACC_SUM + $ACC" | bc)
      EXEC_SUM=$(echo "$EXEC_SUM + $EXEC" | bc)
      MEM_SUM=$(echo "$MEM_SUM + $MEM" | bc)
      LOC_SUM=$((LOC_SUM + LOC))
      CC_SUM=$((CC_SUM + CC))
      PSR_SUM=$((PSR_SUM + PSR))

      VALID_RUNS=$((VALID_RUNS + 1))
    done

    if [ "$VALID_RUNS" -eq 0 ]; then
      echo "No valid runs"
      echo
      continue
    fi

    AVG_ACC=$(echo "scale=3; $ACC_SUM / $VALID_RUNS" | bc)
    AVG_EXEC=$(echo "scale=3; $EXEC_SUM / $VALID_RUNS" | bc)
    AVG_MEM=$(echo "scale=3; $MEM_SUM / $VALID_RUNS" | bc)
    AVG_LOC=$((LOC_SUM / VALID_RUNS))
    AVG_CC=$((CC_SUM / VALID_RUNS))
    AVG_PSR=$((PSR_SUM / VALID_RUNS))

    PASS_AT_K=$([ "$PASSED_RUNS" -ge 1 ] && echo true || echo false)

    echo "  SUMMARY"
    echo "    valid_runs=$VALID_RUNS"
    echo "    passed_runs=$PASSED_RUNS"
    echo "    pass@${K}=$PASS_AT_K"
    echo "    avg_accuracy=$AVG_ACC%"
    echo "    avg_exec_time=${AVG_EXEC}ms"
    echo "    avg_memory=${AVG_MEM}KB"
    echo "    avg_loc=$AVG_LOC"
    echo "    avg_cc=$AVG_CC"
    echo "    avg_psr12_violations=$AVG_PSR"
    echo
    echo "--------------------------------------------------"
    echo
  done
done


# chmod +x debug10.sh
# ./debug10.sh CP-01 CP-01-Evaluator.php 1 for pass@1
# ./debug10.sh CP-01 CP-01-Evaluator.php 10 for pass@10
#.....smae pattern across all exercises
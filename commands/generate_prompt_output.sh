#!/bin/bash

# -----------------------------
# Usage check
# -----------------------------
if [ "$#" -lt 2 ]; then
  echo "Usage: $0 <model_name> <exercise_code> [runs]"
  echo "Example: $0 codellama:7b CP-01 10"
  exit 1
fi

# -----------------------------
# Arguments
# -----------------------------
MODEL="$1"                 # codellama:7b
EXERCISE="$2"              # CP-01
RUNS="${3:-10}"             # default = 10 runs

MODEL_NAME=$(echo "$MODEL" | cut -d':' -f1)

PROMPTS=("zero" "few_shot" "cot")

BASE_PROMPT_DIR="prompts_templates/$EXERCISE"
BASE_OUTPUT_DIR="model_outputs/$EXERCISE/$MODEL_NAME"

# -----------------------------
# Main loop
# -----------------------------
for PROMPT in "${PROMPTS[@]}"; do
  PROMPT_FILE="$BASE_PROMPT_DIR/$PROMPT.txt"

  if [ ! -f "$PROMPT_FILE" ]; then
    echo "Missing prompt file: $PROMPT_FILE"
    continue
  fi

  OUTPUT_DIR="$BASE_OUTPUT_DIR/$PROMPT"
  mkdir -p "$OUTPUT_DIR"

  for ((i=1; i<=RUNS; i++)); do
    OUTPUT_FILE="$OUTPUT_DIR/${PROMPT}${i}.txt"

    echo "Model: $MODEL | $EXERCISE | $PROMPT | Run $i"
    ollama run "$MODEL" < "$PROMPT_FILE" > "$OUTPUT_FILE"
  done
done

echo "Done. Outputs saved in $BASE_OUTPUT_DIR"


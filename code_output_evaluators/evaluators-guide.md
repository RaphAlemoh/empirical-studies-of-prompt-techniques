# Output Evaluators

## Overview

Each coding problem (CP-01 to CP-06) has a dedicated evaluator responsible for validating generated solutions and computing evaluation metrics.

---

## Evaluator Files

- CP-01-Evaluator.php  
- CP-02-Evaluator.php  
- CP-03-Evaluator.php  
- CP-04-Evaluator.php  
- CP-05-Evaluator.php  
- CP-06-Evaluator.php  

Each evaluator loads the corresponding test values and executes the generated solution against them.

---

## Execution Scripts

Two shell scripts are used to automate evaluation:

- `run_passk.sh` — Executes the evaluator to compute metrics (e.g., Pass@k) and stores results in a CSV file for each task.
- `debug10.sh` — Used for debugging generated solutions during evaluation.

---

## Output

Evaluation results are stored in CSV format per task, enabling structured analysis and comparison across models and prompting techniques.

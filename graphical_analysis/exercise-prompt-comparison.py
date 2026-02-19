import pandas as pd
import glob
import os


RESULTS_DIR = "../results"
OUTPUT_DIR = "comparison_tables"

os.makedirs(OUTPUT_DIR, exist_ok=True)


def build_exercise_summary(k_value):
    """
    Builds a single table containing CP-01 to CP-06
    with average accuracy per model and prompt.
    """

    rows = []

    pattern = os.path.join(RESULTS_DIR, f"CP-*_pass@{k_value}.csv")
    files = sorted(glob.glob(pattern))

    for file in files:
        exercise = os.path.basename(file).split("_")[0]

        df = pd.read_csv(file)
        df["avg_accuracy"] = pd.to_numeric(df["avg_accuracy"], errors="coerce").fillna(0)

        # Pivot per exercise
        pivot = df.pivot(
            index="model",
            columns="prompt",
            values="avg_accuracy"
        )

        for model in pivot.index:
            rows.append({
                "Coding Problem": exercise,
                "Model": model,
                "Zero-shot": pivot.loc[model].get("zero", 0),
                "Few-shot": pivot.loc[model].get("few_shot", 0),
                "CoT": pivot.loc[model].get("cot", 0),
            })

    return pd.DataFrame(rows).round(2)


# -------------------------------
# Generate tables
# -------------------------------
pass1_table = build_exercise_summary(k_value=1)
pass10_table = build_exercise_summary(k_value=10)

# Save to CSV
pass1_table.to_csv(f"{OUTPUT_DIR}/CP_01_06_pass_at_1_summary.csv", index=False)
pass10_table.to_csv(f"{OUTPUT_DIR}/CP_01_06_pass_at_10_summary.csv", index=False)

print("\nSaved:")
print(" - CP_01_06_pass_at_1_summary.csv")
print(" - CP_01_06_pass_at_10_summary.csv")

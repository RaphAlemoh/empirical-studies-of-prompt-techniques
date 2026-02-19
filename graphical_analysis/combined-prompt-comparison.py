import pandas as pd
import glob
import os


def load_results_for_k(folder_path, k_value):
    """
    Load and combine all CP-XX_pass@k.csv files into one DataFrame.
    """
    pattern = os.path.join(folder_path, f"CP-*_pass@{k_value}.csv")
    files = glob.glob(pattern)

    all_dfs = []

    for file in files:
        df = pd.read_csv(file)

        # Ensure required columns exist
        if "avg_accuracy" not in df.columns:
            raise ValueError(f"avg_accuracy missing in {file}")

        # Coerce accuracy to numeric and penalise missing
        df["avg_accuracy"] = pd.to_numeric(df["avg_accuracy"], errors="coerce").fillna(0)

        all_dfs.append(df)

    return pd.concat(all_dfs, ignore_index=True)


def build_cross_task_table(df):
    """
    Compute mean accuracy across all coding problems
    grouped by model and prompt.
    """
    summary = (
        df
        .groupby(["model", "prompt"])["avg_accuracy"]
        .mean()
        .reset_index()
    )

    table = summary.pivot(
        index="model",
        columns="prompt",
        values="avg_accuracy"
    )

    table = table.rename(columns={
        "zero": "Zero-shot",
        "few_shot": "Few-shot",
        "cot": "CoT"
    })

    return table.round(2)


# -------------------------------
# MAIN
# -------------------------------
RESULTS_DIR = "../results"  # change if needed

# pass@1
df_pass_1 = load_results_for_k(RESULTS_DIR, k_value=1)
table_pass_1 = build_cross_task_table(df_pass_1)

# pass@10
df_pass_10 = load_results_for_k(RESULTS_DIR, k_value=10)
table_pass_10 = build_cross_task_table(df_pass_10)

print("\nTable 4.16a: Cross-Coding Exercise Performance (pass@1)\n")
print(table_pass_1)

print("\nTable 4.16b: Cross-Coding Exercise Performance (pass@10)\n")
print(table_pass_10)

# Export for thesis
table_pass_1.to_csv("Table_4_16_pass_at_1.csv")
table_pass_10.to_csv("Table_4_16_pass_at_10.csv")

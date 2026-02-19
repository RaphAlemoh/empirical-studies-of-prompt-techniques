import pandas as pd
import matplotlib.pyplot as plt
import numpy as np
import os


PASS1_FILE = "../results/CP-pass@1-result.csv"
PASS10_FILE = "../results/CP-pass@10-result.csv"

OUTPUT_DIR = "figures"

PROMPT_ORDER = ["zero", "few_shot", "cot"]
PROMPT_LABELS = ["Zero-shot", "Few-shot", "CoT"]

METRICS = {
    "avg_accuracy": "Average Accuracy (%)",
    "avg_execution_time_ms": "Execution Time (ms)",
    "avg_cc": "Cyclomatic Complexity",
    "avg_loc": "Lines of Code (LOC)",
    "avg_psr12_violations": "PSR-12 Violations"
}


# =========================
# SETUP
# =========================

os.makedirs(OUTPUT_DIR, exist_ok=True)

df_pass1 = pd.read_csv(PASS1_FILE)
df_pass10 = pd.read_csv(PASS10_FILE)

for df in [df_pass1, df_pass10]:
    df["prompt"] = df["prompt"].str.lower()


# =========================
# PLOTTING FUNCTION
# =========================

def plot_prompt_impact(df, metric, pass_k_label):
    exercises = sorted(df["exercise"].unique())

    x = np.arange(len(PROMPT_ORDER))
    width = 0.12

    plt.figure()

    for i, ex in enumerate(exercises):
        values = []
        for p in PROMPT_ORDER:
            subset = df[
                (df["exercise"] == ex) &
                (df["prompt"] == p)
            ][metric]

            values.append(subset.mean() if not subset.empty else 0)

        plt.bar(
            x + i * width,
            values,
            width,
            label=ex
        )

    plt.xlabel("Prompt Technique")
    plt.ylabel(METRICS[metric])
    plt.title(
        f"Prompt Technique Impact on {METRICS[metric]} "
        f"({pass_k_label})"
    )
    plt.xticks(x + width * (len(exercises) / 2), PROMPT_LABELS)
    plt.legend(title="Exercise", fontsize=8)
    plt.tight_layout()

    filename = (
        f"{OUTPUT_DIR}/"
        f"{pass_k_label.lower().replace('@', '')}_"
        f"prompt_vs_{metric}.png"
    )

    plt.savefig(filename, dpi=300)
    plt.close()

    print(f"Saved: {filename}")


# =========================
# GENERATE FIGURES
# =========================

for metric in METRICS.keys():
    plot_prompt_impact(df_pass1, metric, "Pass@1")
    plot_prompt_impact(df_pass10, metric, "Pass@10")

print("\nAll figures generated successfully.")

import pandas as pd
import os



PASS1_FILE = "../results/CP-pass@1-result.csv"
PASS10_FILE = "../results/CP-pass@10-result.csv"

OUTPUT_DIR = "anova_outputs"
os.makedirs(OUTPUT_DIR, exist_ok=True)



def generate_descriptive_stats(csv_file, output_file):
    df = pd.read_csv(csv_file)

    # Ensure consistent naming
    df["prompt"] = df["prompt"].str.lower()
    df["model"] = df["model"].str.lower()

    # Group and compute stats
    table = (
        df.groupby(["prompt", "model"])["avg_accuracy"]
        .agg(
            N="count",
            Mean="mean",
            SD="std"
        )
        .reset_index()
    )

    table.to_csv(output_file, index=False)

    return table


# =========================
# GENERATE TABLES
# =========================

pass1_table = generate_descriptive_stats(
    PASS1_FILE,
    f"{OUTPUT_DIR}/pass_at_1_descriptive_stats.csv"
)

pass10_table = generate_descriptive_stats(
    PASS10_FILE,
    f"{OUTPUT_DIR}/pass_at_10_descriptive_stats.csv"
)

print("Descriptive statistics tables generated successfully.")

print("\nPass@1 Descriptive Statistics:")
print(pass1_table)

print("\nPass@10 Descriptive Statistics:")
print(pass10_table)

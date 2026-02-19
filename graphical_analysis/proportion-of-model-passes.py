import pandas as pd
import matplotlib.pyplot as plt
import os


PASS1_FILE = "../results/CP-pass@1-result.csv"
PASS10_FILE = "../results/CP-pass@10-result.csv"

OUTPUT_DIR = "figures"
os.makedirs(OUTPUT_DIR, exist_ok=True)


def plot_passed_test_proportion_pie(csv_file, title, output_file):
    df = pd.read_csv(csv_file)

    # Aggregate by model
    summary = (
        df.groupby("model")[["passed_runs", "total_tests"]]
        .sum()
        .reset_index()
    )

    # Compute proportion
    summary["proportion_passed"] = (
        summary["passed_runs"] / summary["total_tests"]
    )

    # Pie chart
    plt.figure()
    plt.pie(
        summary["proportion_passed"],
        labels=summary["model"],
        autopct="%.1f%%",
        startangle=90
    )

    plt.title(title)
    plt.axis("equal")  # ensures a perfect circle
    plt.tight_layout()

    # Save
    plt.savefig(output_file, dpi=300)
    plt.close()

    print(f"Saved: {output_file}")


# =========================
# GENERATE FIGURES
# =========================

plot_passed_test_proportion_pie(
    csv_file=PASS1_FILE,
    title="Proportion of Total Passed Test Cases by Model (Pass@1)",
    output_file=f"{OUTPUT_DIR}/pass_at_1_proportion_passed_tests_pie.png"
)

plot_passed_test_proportion_pie(
    csv_file=PASS10_FILE,
    title="Proportion of Total Passed Test Cases by Model (Pass@10)",
    output_file=f"{OUTPUT_DIR}/pass_at_10_proportion_passed_tests_pie.png"
)

print("\nPie chart figures generated successfully.")

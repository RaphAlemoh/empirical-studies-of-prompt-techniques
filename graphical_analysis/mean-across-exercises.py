import pandas as pd

# Load results
# Change filenames as needed
pass1_df = pd.read_csv("../results/CP-pass@1-result.csv")
pass10_df = pd.read_csv("../results/CP-pass@10-result.csv")

def build_model_summary(df, output_file):
    """
    Builds Model-Level Performance Summary
    (Mean Accuracy Across Exercises)
    """

    # Ensure consistent prompt naming
    df["prompt"] = df["prompt"].str.lower()

    # Group by model and prompt, then compute mean accuracy
    summary = (
        df.groupby(["model", "prompt"])["avg_accuracy"]
        .mean()
        .reset_index()
    )

    # Pivot to table format
    table = summary.pivot(
        index="model",
        columns="prompt",
        values="avg_accuracy"
    )

    # Rename columns to match thesis table
    table = table.rename(columns={
        "zero": "Zero-shot Mean",
        "few_shot": "Few-shot Mean",
        "cot": "CoT Mean"
    })

    # Reset index so "Model" becomes a column
    table = table.reset_index().rename(columns={"model": "Model"})

    # Save to CSV
    table.to_csv(output_file, index=False)

    return table


# Generate tables
pass1_table = build_model_summary(pass1_df, "pass_at_1_model_summary.csv")
pass10_table = build_model_summary(pass10_df, "pass_at_10_model_summary.csv")

print("Pass@1 Model Summary:")
print(pass1_table)

print("\nPass@10 Model Summary:")
print(pass10_table)

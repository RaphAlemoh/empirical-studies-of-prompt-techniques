import pandas as pd
import matplotlib.pyplot as plt
import numpy as np


def plot_mean_accuracy_prompt_x(csv_file, title, output_file):
    # Load CSV
    df = pd.read_csv(csv_file)

    prompts = ["Zero-shot Mean", "Few-shot Mean", "CoT Mean"]
    models = df["Model"].tolist()

    x = np.arange(len(prompts))   # prompt positions
    width = 0.25                  # bar width

    plt.figure()

    # Plot bars for each model
    for i, model in enumerate(models):
        plt.bar(
            x + i * width,
            df.loc[df["Model"] == model, prompts].values.flatten(),
            width,
            label=model
        )

    # Formatting
    plt.xlabel("Prompt Technique")
    plt.ylabel("Mean Accuracy (%)")
    plt.title(title)
    plt.xticks(x + width, ["Zero-shot", "Few-shot", "CoT"])
    plt.legend(title="Model")
    plt.tight_layout()

    # Save figure
    plt.savefig(output_file, dpi=300)
    plt.close()


# Pass@1 chart
plot_mean_accuracy_prompt_x(
    csv_file="pass_at_1_model_summary.csv",
    title="Mean Accuracy by Prompt Technique and Model (Pass@1)",
    output_file="pass_at_1_prompt_mean_summary.png"
)

# Pass@10 chart
plot_mean_accuracy_prompt_x(
    csv_file="pass_at_10_model_summary.csv",
    title="Mean Accuracy by Prompt Technique and Model (Pass@10)",
    output_file="pass_at_10_prompt_mean_summary.png"
)

print("Charts with prompt on x-axis generated successfully.")

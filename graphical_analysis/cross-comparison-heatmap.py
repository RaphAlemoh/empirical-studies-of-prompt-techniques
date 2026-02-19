import os
import pandas as pd
import matplotlib.pyplot as plt
import seaborn as sns

# Ensure output directory exists
OUTPUT_DIR = "heatmap_diagrams"
os.makedirs(OUTPUT_DIR, exist_ok=True)

def save_heatmap(csv_path, output_filename, title, colorbar_label):
    # Load data
    df = pd.read_csv(csv_path)

    # Combine Coding Problem and Model for y-axis
    df["Task_Model"] = df["Coding Problem"] + " - " + df["Model"]

    # Prepare heatmap data
    heatmap_data = df.set_index("Task_Model")[["Zero-shot", "Few-shot", "CoT"]]

    # Create heatmap
    plt.figure(figsize=(8, 10))
    sns.heatmap(
        heatmap_data,
        annot=True,
        fmt=".1f",
        cmap="YlGnBu",
        cbar_kws={"label": colorbar_label}
    )

    plt.xlabel("Prompt Technique")
    plt.ylabel("Coding Problem / Model")
    plt.title(title)

    plt.tight_layout()

    # Save figure
    output_path = os.path.join(OUTPUT_DIR, output_filename)
    plt.savefig(output_path, dpi=300, bbox_inches="tight")
    plt.close()


# -------- Pass@1 Heatmap --------
save_heatmap(
    csv_path="comparison_tables/CP_01_06_pass_at_1_summary.csv",
    output_filename="pass1_cross_task_heatmap.png",
    title="Pass@1 Performance Across Tasks, Models, and Prompting Techniques",
    colorbar_label="Pass@1 Accuracy (%)"
)

# -------- Pass@10 Heatmap --------
save_heatmap(
    csv_path="comparison_tables/CP_01_06_pass_at_10_summary.csv",
    output_filename="pass10_cross_task_heatmap.png",
    title="Pass@10 Performance Across Tasks, Models, and Prompting Techniques",
    colorbar_label="Pass@10 Accuracy (%)"
)

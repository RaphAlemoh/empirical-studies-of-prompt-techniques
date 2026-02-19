import pandas as pd
import matplotlib.pyplot as plt
import numpy as np

# Load CSV for pass@1 accuracy data and pass@1 accuracy data for each model-prompt combination
df = pd.read_csv("results.csv")

# Filter for pass@1
df_pass1 = df[df["k"] == 1]

# Create a combined Model-Prompt label
df_pass1["model_prompt"] = df_pass1["model"] + " | " + df_pass1["prompt"]

# Pivot table: Exercise x (Model | Prompt)
heatmap_data = df_pass1.pivot_table(
    index="exercise",
    columns="model_prompt",
    values="avg_accuracy",
    aggfunc="mean"
)

# Sort exercises logically if needed
heatmap_data = heatmap_data.sort_index()

# Convert to numpy for plotting
data = heatmap_data.values

# Plot heatmap using matplotlib
plt.figure(figsize=(14, 6))
im = plt.imshow(data, aspect="auto")

# Axis labels
plt.xticks(
    ticks=np.arange(len(heatmap_data.columns)),
    labels=heatmap_data.columns,
    rotation=45,
    ha="right"
)
plt.yticks(
    ticks=np.arange(len(heatmap_data.index)),
    labels=heatmap_data.index
)

plt.xlabel("Model | Prompt")
plt.ylabel("Exercise")
plt.title("Accuracy Heatmap (pass@1): Exercise × Model × Prompt")

# Colorbar
cbar = plt.colorbar(im)
cbar.set_label("Average Accuracy (%)")

# Annotate values inside cells
for i in range(data.shape[0]):
    for j in range(data.shape[1]):
        value = data[i, j]
        if not np.isnan(value):
            plt.text(
                j, i,
                f"{value:.1f}",
                ha="center",
                va="center",
                fontsize=8
            )

plt.tight_layout()
plt.show()

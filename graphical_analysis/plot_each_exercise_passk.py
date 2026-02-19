import pandas as pd
import matplotlib.pyplot as plt
import numpy as np
from pathlib import Path
import re


def plot_passk_by_prompt(
    pass1_csv,
    pass10_csv,
    exercise_code,
    metric="avg_accuracy",
    output_dir="figures_passk_prompt_comparison"
):
    df1 = pd.read_csv(pass1_csv)
    df10 = pd.read_csv(pass10_csv)

    prompts = ["zero", "few_shot", "cot"]
    models = sorted(set(df1["model"]).union(df10["model"]))

    # ---- spacing between prompt groups ----
    group_spacing = 1.4
    x = np.arange(len(prompts)) * group_spacing
    bar_width = 0.15

    plt.figure(figsize=(10, 6))

    offset = 0
    for model in models:
        for df, k in [(df1, 1), (df10, 10)]:
            subset = (
                df[df["model"] == model]
                .set_index("prompt")
                .reindex(prompts)
            )

            values = subset[metric].fillna(0).values

            plt.bar(
                x + offset,
                values,
                bar_width,
                label=f"{model} pass@{k}"
            )
            offset += bar_width

        offset += bar_width  # space between models

    plt.xticks(x + bar_width, ["Zero-shot", "Few-shot", "CoT"])
    plt.xlabel("Prompt Technique")
    plt.ylabel(metric.replace("_", " ").title())
    plt.title(f"{exercise_code}: Pass@1 vs Pass@10 by Prompt Technique")
    plt.legend()
    plt.tight_layout()

    output_path = Path(output_dir)
    output_path.mkdir(parents=True, exist_ok=True)

    filename = output_path / f"{exercise_code}_pass1_vs_pass10_prompt_impact.png"
    plt.savefig(filename, dpi=300)
    plt.close()

    print(f"[OK] Saved {filename}")


def extract_exercise_code(filename):
    match = re.match(r"(CP-\d+)_pass@1\.csv", filename)
    return match.group(1) if match else None


if __name__ == "__main__":
    results_dir = Path("../results")

    pass1_files = list(results_dir.glob("*_pass@1.csv"))

    if not pass1_files:
        raise RuntimeError("No pass@1 result files found.")

    for pass1_file in pass1_files:
        exercise_code = extract_exercise_code(pass1_file.name)

        if not exercise_code:
            continue

        pass10_file = results_dir / f"{exercise_code}_pass@10.csv"

        if not pass10_file.exists():
            print(f"[SKIP] Missing pass@10 file for {exercise_code}")
            continue

        plot_passk_by_prompt(
            pass1_csv=pass1_file,
            pass10_csv=pass10_file,
            exercise_code=exercise_code
        )

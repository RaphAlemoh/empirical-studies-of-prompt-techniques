import os
import pandas as pd
import seaborn as sns
import matplotlib.pyplot as plt
from scipy.stats import shapiro, levene
import statsmodels.api as sm
from statsmodels.formula.api import ols

# =========================
# CONFIG
# =========================

PASS1_FILE = "../results/CP-pass@1-result.csv"
PASS10_FILE = "../results/CP-pass@10-result.csv"

METRICS = [
    "avg_accuracy",
    "avg_loc",
    "avg_cc",
    "avg_execution_time_ms",
    "avg_psr12_violations",
    "avg_memory_kb"
]

BASE_OUTPUT_DIR = "anova_outputs"


# =========================
# PIPELINE FUNCTION
# =========================

def run_pipeline(input_csv, pass_label):

    print(f"\nRunning full ANOVA pipeline for {pass_label}...\n")

    OUTPUT_DIR = os.path.join(BASE_OUTPUT_DIR, pass_label)
    TABLE_DIR = os.path.join(OUTPUT_DIR, "tables")
    FIG_DIR = os.path.join(OUTPUT_DIR, "figures")
    REP_DIR = os.path.join(OUTPUT_DIR, "reports")

    os.makedirs(TABLE_DIR, exist_ok=True)
    os.makedirs(FIG_DIR, exist_ok=True)
    os.makedirs(REP_DIR, exist_ok=True)

    df = pd.read_csv(input_csv)
    df.columns = df.columns.str.strip().str.lower()

    df["prompt"] = df["prompt"].astype("category")
    df["model"] = df["model"].astype("category")

    for metric in METRICS:
        print(f"Processing: {metric}")

        df[metric] = pd.to_numeric(df[metric], errors="coerce")

        # =========================
        # DESCRIPTIVE STATS
        # =========================
        desc = (
            df.groupby(["prompt", "model"], observed=True)[metric]
            .agg(N="count", Mean="mean", SD="std")
            .reset_index()
        )

        desc_path = os.path.join(TABLE_DIR, f"{metric}_descriptive_stats.csv")
        desc.to_csv(desc_path, index=False)

        # =========================
        # NORMALITY
        # =========================
        norm_rows = []

        for (prompt, model), group in df.groupby(["prompt", "model"], observed=True):
            values = group[metric].dropna()

            if len(values) < 3 or values.nunique() <= 1:
                norm_rows.append([prompt, model, "N/A", "Zero variance or N<3"])
            else:
                stat, p = shapiro(values)
                norm_rows.append([prompt, model, round(stat, 4), round(p, 4)])

        norm_df = pd.DataFrame(
            norm_rows,
            columns=["Prompt", "Model", "Shapiro_W", "p_value"]
        )

        norm_path = os.path.join(TABLE_DIR, f"{metric}_normality.csv")
        norm_df.to_csv(norm_path, index=False)

        # =========================
        # LEVENE TEST
        # =========================
        groups = []
        for _, g in df.groupby(["prompt", "model"], observed=True):
            vals = g[metric].dropna()
            if len(vals) > 1 and vals.nunique() > 1:
                groups.append(vals.values)

        if len(groups) >= 2:
            lev_stat, lev_p = levene(*groups)
            lev_stat, lev_p = round(lev_stat, 4), round(lev_p, 4)
        else:
            lev_stat, lev_p = "N/A", "Insufficient variance"

        # =========================
        # CHECK CONSTANT METRIC
        # =========================
        if df[metric].nunique() <= 1:
            anova_table = pd.DataFrame(
                {"Note": ["Metric constant across conditions. ANOVA not applicable."]}
            )
            valid = False
        else:
            formula = f"{metric} ~ C(prompt) * C(model)"
            model = ols(formula, data=df).fit()
            try:
                anova_table = sm.stats.anova_lm(model, typ=2)
                valid = True
            except Exception:
                anova_table = pd.DataFrame(
                    {"Note": ["ANOVA not computable due to zero residual variance."]}
                )
                valid = False

        anova_path = os.path.join(TABLE_DIR, f"{metric}_anova.csv")
        anova_table.to_csv(anova_path)

        # =========================
        # INTERACTION PLOT
        # =========================
        plt.figure()
        sns.pointplot(
            data=df,
            x="prompt",
            y=metric,
            hue="model",
            dodge=True,
            capsize=0.1
        )

        plt.title(f"{pass_label}: Prompt × Model Interaction on {metric}")
        plt.xlabel("Prompt Technique")
        plt.ylabel(metric.replace("_", " ").title())

        interaction_path = os.path.join(FIG_DIR, f"{metric}_interaction.png")
        plt.savefig(interaction_path, dpi=300, bbox_inches="tight")
        plt.close()

        # =========================
        # BAR PLOT
        # =========================
        plt.figure()
        sns.barplot(
            data=df,
            x="prompt",
            y=metric,
            hue="model",
            errorbar="sd"
        )

        plt.title(f"{pass_label}: Mean {metric.replace('_',' ').title()}")
        plt.xlabel("Prompt Technique")
        plt.ylabel(metric.replace("_", " ").title())

        bar_path = os.path.join(FIG_DIR, f"{metric}_bar.png")
        plt.savefig(bar_path, dpi=300, bbox_inches="tight")
        plt.close()

        # =========================
        # REPORT FILE
        # =========================
        report_path = os.path.join(REP_DIR, f"{metric}_report.txt")

        with open(report_path, "w") as f:
            f.write(f"STATISTICAL REPORT — {metric.upper()} ({pass_label})\n")
            f.write("=" * 60 + "\n\n")
            f.write("Descriptive Statistics File:\n")
            f.write(desc_path + "\n\n")
            f.write("Normality Test File:\n")
            f.write(norm_path + "\n\n")
            f.write("Levene’s Test:\n")
            f.write(f"Statistic: {lev_stat}, p-value: {lev_p}\n\n")
            f.write("ANOVA Table:\n")
            f.write(anova_path + "\n")

        print(f"  Completed: {metric}")

    print(f"\nAll metrics processed for {pass_label}.\n")


# =========================
# RUN BOTH ANALYSES
# =========================

run_pipeline(PASS1_FILE, "pass_at_1")
run_pipeline(PASS10_FILE, "pass_at_10")

print("Full statistical pipeline complete.")

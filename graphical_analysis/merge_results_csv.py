import csv
import glob

def merge(pattern, output):
    files = sorted(glob.glob(pattern))
    if not files:
        print(f"No files found for {pattern}")
        return

    with open(output, "w", newline="") as out:
        writer = None

        for i, file in enumerate(files):
            with open(file, newline="") as f:
                reader = csv.reader(f)
                header = next(reader)

                if i == 0:
                    writer = csv.writer(out)
                    writer.writerow(header)

                for row in reader:
                    writer.writerow(row)

    print(f"Created {output}")

merge("../results/CP-*_pass@1.csv", "../results/CP-pass@1-result.csv")
merge("../results/CP-*_pass@10.csv", "../results/CP-pass@10-result.csv")

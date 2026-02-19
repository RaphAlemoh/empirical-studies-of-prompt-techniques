# Extractor

## Overview

The `model_code_extractor/` module contains a PHP script designed to automatically extract the target function from generated model outputs for each exercise (CP-01 to CP-06).

This enables standardized isolation of the required function before evaluation.

---

## Script

`bulk_extractor.php`

The script performs bulk extraction of the expected function from generated code files and saves the extracted function into the corresponding directory for evaluation.

---

## Usage

Run the extractor using the following pattern:

```bash
php extraction/bulk_extractor.php <input_directory> <output_directory> <function_name>

// php extraction/bulk_extractor.php model_outputs/CP-01 code_extraction/CP-01 removeDuplicates
// php extraction/bulk_extractor.php model_outputs/CP-02 code_extraction/CP-02 isValid
// php extraction/bulk_extractor.php model_outputs/CP-03 code_extraction/CP-03 searchMatrix
// php extraction/bulk_extractor.php model_outputs/CP-04 code_extraction/CP-04 maxProfit
// php extraction/bulk_extractor.php model_outputs/CP-05 code_extraction/CP-05 trap
// php extraction/bulk_extractor.php model_outputs/CP-06 code_extraction/CP-06 mergeKLists
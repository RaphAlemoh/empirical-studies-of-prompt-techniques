<?php

use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
/**
 * Flexible recursive function extractor
 *
 * Usage:
 * php bulk_extractor.php <input-root> <output-root> <functionName>
 */

if ($argc < 4) {
    fwrite(STDERR, "Usage: php bulk_extractor.php <input-root> <output-root> <functionName>\n");
    exit(1);
}

$inputRoot   = rtrim($argv[1], '/');
$outputRoot  = rtrim($argv[2], '/');
$functionName = $argv[3];

if (!is_dir($inputRoot)) {
    fwrite(STDERR, "Input folder not found: {$inputRoot}\n");
    exit(1);
}

function extractFunction(string $raw, string $functionName): ?string
{
    $pattern = '/function\s+' . preg_quote($functionName, '/') . '\s*\(/';
    if (!preg_match($pattern, $raw, $match, PREG_OFFSET_CAPTURE)) {
        return null;
    }

    $start = $match[0][1];
    $code  = substr($raw, $start);

    $braceCount = 0;
    $foundOpeningBrace = false;
    $result = '';

    for ($i = 0; $i < strlen($code); $i++) {
        $char = $code[$i];
        $result .= $char;

        if ($char === '{') {
            $braceCount++;
            $foundOpeningBrace = true;
        } elseif ($char === '}') {
            $braceCount--;
            if ($foundOpeningBrace && $braceCount === 0) {
                break;
            }
        }
    }

    return "<?php\n\n" . trim($result) . "\n";
}

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($inputRoot, FilesystemIterator::SKIP_DOTS)
);

foreach ($iterator as $file) {
    if ($file->getExtension() !== 'txt') {
        continue;
    }

    $relativePath = str_replace($inputRoot . '/', '', $file->getPathname());
    $outputPath   = $outputRoot . '/' . preg_replace('/\.txt$/', '.php', $relativePath);

    $raw = file_get_contents($file->getPathname());
    $extracted = extractFunction($raw, $functionName);

    $outDir = dirname($outputPath);
    if (!is_dir($outDir)) {
        mkdir($outDir, 0777, true);
    }

    if ($extracted === null) {
        file_put_contents($outputPath, "<?php\n");
        echo "Empty PHP: {$outputPath}\n";
    } else {
        file_put_contents($outputPath, $extracted);
        echo "Extracted: {$outputPath}\n";
    }
}

echo "\nDone.\n";



// php model_code_extractor/bulk_extractor.php model_outputs/CP-01 code_extraction/CP-01 removeDuplicates
// php model_code_extractor/bulk_extractor.php model_outputs/CP-02 code_extraction/CP-02 isValid
// php model_code_extractor/bulk_extractor.php model_outputs/CP-03 code_extraction/CP-03 searchMatrix
// php model_code_extractor/bulk_extractor.php model_outputs/CP-04 code_extraction/CP-04 maxProfit
// php model_code_extractor/bulk_extractor.php model_outputs/CP-05 code_extraction/CP-05 trap
// php model_code_extractor/bulk_extractor.php model_outputs/CP-06 code_extraction/CP-06 mergeKLists
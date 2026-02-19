<?php

error_reporting(0);
ini_set('display_errors', '0');

$generatedFile = $argv[1];
$tests = require __DIR__ . '/../tests/CP-03.php';

/**
 * Default metrics (failure-safe)
 */
$result = [
    "accuracy" => 0.0,
    "total" => count($tests),
    "passed" => 0,
    "execution_time_ms" => 0.0,
    "memory_kb" => 0.0,
    "status" => "ok"
];

/**
 * 1. Load generated file safely
 */
try {
    require $generatedFile;
} catch (Throwable $e) {
    $result["status"] = "load_error";
    echo json_encode($result);
    exit;
}

/**
 * 2. Check required function exists
 */
if (!function_exists('searchMatrix')) {
    $result["status"] = "missing_function";
    echo json_encode($result);
    exit;
}

/**
 * 3. Accuracy
 */
$passed = 0;

foreach ($tests as $test) {
    try {
        $actual = searchMatrix($test['matrix'], $test['target']);
        if ($actual === $test['expected']) {
            $passed++;
        }
    } catch (Throwable $e) {
        continue;
    }
}

$total = count($tests);
$accuracy = $total > 0 ? ($passed / $total) * 100 : 0;

/**
 * 4. Execution time
 */
$startTime = microtime(true);
foreach ($tests as $test) {
    try {
        searchMatrix($test['matrix'], $test['target']);
    } catch (Throwable $e) {}
}
$executionTimeMs = (microtime(true) - $startTime) * 1000;

/**
 * 5. Memory usage
 */
$startMem = memory_get_usage();
foreach ($tests as $test) {
    try {
        searchMatrix($test['matrix'], $test['target']);
    } catch (Throwable $e) {}
}
$memoryKb = (memory_get_usage() - $startMem) / 1024;

/**
 * 6. Final result
 */
$result["accuracy"] = round($accuracy, 2);
$result["passed"] = $passed;
$result["execution_time_ms"] = round($executionTimeMs, 3);
$result["memory_kb"] = round($memoryKb, 2);

echo json_encode($result);

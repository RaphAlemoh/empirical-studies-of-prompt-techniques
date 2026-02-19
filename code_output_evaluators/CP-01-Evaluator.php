<?php

error_reporting(0);
ini_set('display_errors', '0');

$generatedFile = $argv[1];

$tests = require __DIR__ . '/../tests/CP-01.php';
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


try {
    require $generatedFile;
} catch (Throwable $e) {
    $result["status"] = "load_error";
    echo json_encode($result);
    exit;
}

if (!function_exists('removeDuplicates')) {
    $result["status"] = "missing_function";
    echo json_encode($result);
    exit;
}


$passed = 0;

foreach ($tests as $test) {
    try {
        [$nums, $expectedK, $expectedNums] = $test;

        $numsCopy = $nums;
        $k = removeDuplicates($numsCopy);

        $pass = ($k === $expectedK);

        if ($pass) {
            for ($i = 0; $i < $k; $i++) {
                if (!isset($numsCopy[$i]) || $numsCopy[$i] !== $expectedNums[$i]) {
                    $pass = false;
                    break;
                }
            }
        }

        if ($pass) {
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
        [$nums, $expectedK, $expectedNums] = $test;
        $numsCopy = $nums;
        removeDuplicates($numsCopy);
    } catch (Throwable $e) {
    }
}
$executionTimeMs = (microtime(true) - $startTime) * 1000;

/**
 * 5. Memory usage
 */
$startMem = memory_get_usage();
foreach ($tests as $test) {
    try {
        [$nums, $expectedK, $expectedNums] = $test;
        $numsCopy = $nums;
        removeDuplicates($numsCopy);
    } catch (Throwable $e) {
    }
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

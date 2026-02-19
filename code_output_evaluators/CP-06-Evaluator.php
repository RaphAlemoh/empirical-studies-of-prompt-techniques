<?php

error_reporting(0);
ini_set('display_errors', '0');

$generatedFile = $argv[1];
$tests = require __DIR__ . '/../tests/CP-05.php';
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
if (!function_exists('mergeKLists')) {
    $result["status"] = "missing_function";
    echo json_encode($result);
    exit;
}


/**
 * Helper: Converts array to ListNode chain
 */
function buildLinkedList(array $values) {
    $dummy = new ListNode();
    $current = $dummy;

    foreach ($values as $v) {
        $current->next = new ListNode($v);
        $current = $current->next;
    }

    return $dummy->next;
}

/**
 * Helper: Convert ListNode to array
 */
function toArray($node) {
    $arr = [];

    while ($node !== null) {
        $arr[] = $node->val;
        $node = $node->next;
    }

    return $arr;
}


/**
 * 3. Accuracy
 */
$passed = 0;

foreach ($tests as $test) {
    try {
        $inputLists = [];
        foreach ($test['lists'] as $list) {
            $inputLists[] = buildLinkedList($list);
        }

        $merged = mergeKLists($inputLists);
        $actual = toArray($merged);

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
        $inputLists = [];
        foreach ($test['lists'] as $list) {
            $inputLists[] = buildLinkedList($list);
        }

        mergeKLists($inputLists);
    } catch (Throwable $e) {}
}
$executionTimeMs = (microtime(true) - $startTime) * 1000;

/**
 * 5. Memory usage
 */
$startMem = memory_get_usage();
foreach ($tests as $test) {
    try {
        $inputLists = [];
        foreach ($test['lists'] as $list) {
            $inputLists[] = buildLinkedList($list);
        }

        mergeKLists($inputLists);
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

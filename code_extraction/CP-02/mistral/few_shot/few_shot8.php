<?php

function isValid(string $s): bool {
    $stack = [];
    $bracketsMap = ['{', '[', '(' => '}', ']', ')'];

    foreach (str_split($s) as $ch) {
        if (!empty($stack) && array_key_exists($ch, $bracketsMap) && $bracketsMap[$ch] === array_pop($stack)) {
            continue;
        }

        if (!array_key_exists($ch, $bracketsMap)) {
            return false;
        }

        $stack[] = $ch;
    }

    return empty($stack);
}

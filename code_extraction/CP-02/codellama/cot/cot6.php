<?php

function isValid(string $s): bool {
    $stack = [];
    foreach (str_split($s) as $char) {
        if ($char === '(' || $char === '[' || $char === '{') {
            array_push($stack, $char);
        } else {
            $lastChar = array_pop($stack);
            if ($char !== match ($lastChar) {
                case ')': '(';
                case ']': '[';
                case '}': '{';
                default: throw new \Exception("Unexpected character: $lastChar");
            }
        }
    }
    return count($stack) === 0;
}

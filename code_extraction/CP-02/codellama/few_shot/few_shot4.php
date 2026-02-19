<?php

function isValid(string $s): bool {
    $stack = [];
    $chars = str_split($s);

    foreach ($chars as $ch) {
        switch ($ch) {
            case '(':
            case '{':
            case '[':
                // Opening bracket, push to stack
                $stack[] = $ch;
                break;
            case ')':
            case '}':
            case ']':
                // Closing bracket, pop from stack and compare
                if (empty($stack) || array_pop($stack) !== $ch) {
                    return false;
                }
                break;
        }
    }

    // Check if stack is empty
    return empty($stack);
}

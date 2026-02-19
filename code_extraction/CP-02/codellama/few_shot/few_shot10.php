<?php

function isValid(string $s): bool {
    $stack = [];
    $chars = str_split($s);

    foreach ($chars as $ch) {
        if ($ch === '(' || $ch === '[' || $ch === '{') {
            $stack[] = $ch;
        } elseif ($ch === ')' || $ch === ']' || $ch === '}') {
            if (empty($stack)) {
                return false;
            }

            $top = end($stack);

            if ($ch !== match($top)) {
                return false;
            }

            array_pop($stack);
        } else {
            return false;
        }
    }

    return empty($stack);
}

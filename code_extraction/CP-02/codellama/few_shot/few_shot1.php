<?php

function isValid(string $s): bool {
    $stack = [];
    $chars = str_split($s);

    foreach ($chars as $ch) {
        switch ($ch) {
            case '(':
                $stack[] = ')';
                break;
            case '{':
                $stack[] = '}';
                break;
            case '[':
                $stack[] = ']';
                break;
            default:
                if (empty($stack) || array_pop($stack) !== $ch) {
                    return false;
                }
                break;
        }
    }

    return empty($stack);
}

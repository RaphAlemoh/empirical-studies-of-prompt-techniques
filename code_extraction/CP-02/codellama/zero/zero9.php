<?php

function isValid(string $s): bool {
    $stack = [];
    for ($i = 0; $i < strlen($s); $i++) {
        switch ($s[$i]) {
            case '(':
                array_push($stack, ')');
                break;
            case '{':
                array_push($stack, '}');
                break;
            case '[':
                array_push($stack, ']');
                break;
            default:
                if (empty($stack) || end($stack) !== $s[$i]) {
                    return false;
                }
                array_pop($stack);
                break;
        }
    }
    return empty($stack);
}

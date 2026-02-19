<?php

function isValid($s) {
    $stack = [];
    for ($i = 0; $i < strlen($s); $i++) {
        switch ($s[$i]) {
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
                if (empty($stack) || array_pop($stack) !== $s[$i]) {
                    return false;
                }
        }
    }

    return empty($stack);
}

<?php

function isValid($s) {
    $stack = [];
    for ($i = 0; $i < strlen($s); $i++) {
        if ($s[$i] == '(' || $s[$i] == '[' || $s[$i] == '{') {
            array_push($stack, $s[$i]);
        } else if ($s[$i] == ')' || $s[$i] == ']' || $s[$i] == '}') {
            $lastChar = end($stack);
            if (($lastChar == '(' && $s[$i] != ')') ||
                ($lastChar == '[' && $s[$i] != ']') ||
                ($lastChar == '{' && $s[$i] != '}')) {
                    return false;
                } else {
                    array_pop($stack);
            }
        }
    }
    if (count($stack) > 0) {
        return false;
    }
    return true;
}

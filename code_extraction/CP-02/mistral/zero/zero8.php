<?php

function isValid($s) {
    $openingBrackets = ['(', '[', '{'];
    $closingBrackets = [')', ']', '}'];
    $stack = [];

    for ($i = 0; $i < strlen($s); $i++) {
        if (in_array($s[$i], $openingBrackets)) {
            array_push($stack, $s[$i]);
        } elseif (in_array($s[$i], $closingBrackets)) {
            if (empty($stack) || $stack[count($stack) - 1] !== str_replace($closingBrackets, $openingBrackets, $s[$i])) {
                return false;
            }
            array_pop($stack);
        }
    }

    return empty($stack);
}

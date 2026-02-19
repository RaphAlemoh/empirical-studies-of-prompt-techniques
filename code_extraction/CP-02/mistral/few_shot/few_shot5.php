<?php

function isValid(string $s): bool {
    $stack = [];
    $validBrackets = ['(', '{', '['];
    $openingBrackets = [')', '}', ']'];

    foreach (str_split($s) as $ch) {
        if (!in_array($ch, $validBrackets) && !empty($stack) && strpos($openingBrackets, $stack[count($stack) - 1]) === strrpos($openingBrackets, $ch)) {
            array_pop($stack);
        } else if (!in_array($ch, $validBrackets)) {
            return false;
        } else {
            $stack[] = $ch;
        }
    }

    return empty($stack);
}

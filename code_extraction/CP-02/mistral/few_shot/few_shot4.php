<?php

function isValid(string $s): bool {
    $openingBrackets = ['(', '[', '{'];
    $closingBrackets = [')', ']', '}'];
    $stack = [];

    foreach (str_split($s) as $char) {
        if (in_array($char, $openingBrackets)) {
            $stack[] = $char;
        } elseif (in_array($char, $closingBrackets)) {
            if (!empty($stack) && array_pop($stack) === str_replace(']', '}', $char)) {
                continue; // Skip to the next character after popping and checking.
            } else {
                return false;
            }
        }
    }

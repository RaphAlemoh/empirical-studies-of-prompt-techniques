<?php

function isValid(string $s): bool {
    // Initialize an empty stack to store opening brackets
    $stack = [];

    // Iterate through each character in the string
    foreach ($s as $ch) {
        // If the current character is an opening bracket, push it onto the stack
        if (in_array($ch, ['(', '{', '['])) {
            $stack[] = $ch;
        } elseif (in_array($ch, [')', '}', ']'])) {
            // If the current character is a closing bracket, pop the top element from the stack and compare it with the current character
            if (count($stack) === 0 || !in_array(end($stack), $ch)) {
                return false;
            } else {
                array_pop($stack);
            }
        }
    }

    // If there are still elements in the stack, it means that there are unmatched opening brackets
    return count($stack) === 0;
}

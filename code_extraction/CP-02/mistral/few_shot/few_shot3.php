<?php

function isValid(string $s): bool {
    $stack = [];
    $mapping = ['{', '}', '[', ']', '(', ')'];

    foreach (str_split($s) as $ch) {
        $index = array_search($ch, $mapping);

        if ($index !== false) {
            // If it's an opening bracket, push it onto the stack.
            if ($index === count($mapping)) {
                $stack[] = $ch;
            } else {
                // If it's a closing bracket, check if the corresponding opening bracket is in the stack and pop it off.
                if (count($stack) > 0 && $stack[count($stack) - 1] === $mapping[$index + 1]) {
                    array_pop($stack);
                } else {
                    // If no corresponding opening bracket is found, return false.
                    return false;
                }
            }
        } else {
            // If the character is not a valid bracket, return false.
            return false;
        }
    }

    // If all closing brackets have been popped from the stack and the stack is empty, return true.
    return count($stack) === 0;
}

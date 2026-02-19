<?php

function isValid($s) {
    $stack = [];

    for ($i = 0; $i < strlen($s); $i++) {
        $char = $s[$i];
        if ($char == '(' || $char == '[' || $char == '{') {
            // Push the character onto the stack
            array_push($stack, $char);
        } elseif ($char == ')' || $char == ']' || $char == '}') {
            // Pop the top character from the stack and check if it matches
            $topChar = array_pop($stack);
            if ($topChar != null && $topChar != $char) {
                return false;
            }
        }
    }

    // Check if there are still characters left in the stack
    return count($stack) == 0;
}

<?php

function isValid($s) {
    $stack = array();
    for ($i = 0; $i < strlen($s); $i++) {
        if (strpos('()[]{}', $s[$i]) !== false) { // check if the current character is an opening bracket
            array_push($stack, $s[$i]);
        } else { // check if the current character is a closing bracket
            if (empty($stack)) {
                return false;
            }
            $top = array_pop($stack);
            if ($top !== match($s[$i])) { // check if the closing bracket matches with the opening bracket at the top of the stack
                return false;
            }
        }
    }
    return empty($stack); // check if the stack is empty, if not then it means there are still opening brackets left
}

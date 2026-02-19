<?php

function isValid($s) {
    $stack = [];
    $chars = str_split($s);

    foreach ($chars as $ch) {
        if ($ch == "(" || $ch == "[" || $ch == "{") {
            $stack[] = $ch;
        } else if ($ch == ")" || $ch == "]" || $ch == "}") {
            if (empty($stack)) {
                return false;
            }
            $lastChar = array_pop($stack);
            if ($lastChar != $ch) {
                return false;
            }
        } else {
            // Invalid character
            return false;
        }
    }

    if (!empty($stack)) {
        return false;
    }

    return true;
}

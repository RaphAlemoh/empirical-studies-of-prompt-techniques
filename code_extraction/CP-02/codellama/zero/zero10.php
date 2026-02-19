<?php

function isValid($s) {
    $openBrackets = ['(', '{', '['];
    $closeBrackets = [')', '}', ']'];
    $stack = [];

    for ($i = 0; $i < strlen($s); $i++) {
        $char = $s[$i];
        if (in_array($char, $openBrackets)) {
            array_push($stack, $char);
        } else if (in_array($char, $closeBrackets)) {
            $lastOpenBracket = end($stack);
            if ($lastOpenBracket !== null && $closeBrackets[$lastOpenBracket] == $char) {
                array_pop($stack);
            } else {
                return false;
            }
        }
    }

    return empty($stack);
}

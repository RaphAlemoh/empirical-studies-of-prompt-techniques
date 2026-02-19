<?php

function isValid(string $s): bool {
    $openingBrackets = ['(', '{', '['];
    $closingBrackets = [')', '}', ']'];
    $stack = [];

    for ($i = 0; $i < strlen($s); ++$i) {
        $char = $s[$i];

        if (in_array($char, $openingBrackets)) {
            $stack[] = $char;
        } elseif (in_array($char, $closingBrackets)) {
            if (!$stack || $stack[count($stack) - 1] !== str_replace($closingBrackets, $openingBrackets, $char)) {
                return false;
            }

            array_pop($stack);
        }
    }

    return empty($stack);
}

<?php

function isValid(string $s): bool {
    if (empty($s)) {
        return false;
    }

    $stack = [];
    $openers = ['{', '[', '('];
    $closers = [']', ')', '}'];

    foreach (str_split($s) as $char) {
        if (in_array($char, $openers)) {
            $stack[] = $char;
        } elseif (in_array($char, $closers)) {
            if ($stack === [] || !matchClosingBracket($stack[count($stack) - 1], $char)) {
                return false;
            }
            array_pop($stack);
        }
    }

    // Check if there are any open brackets left in the stack.
    return empty($stack);
}

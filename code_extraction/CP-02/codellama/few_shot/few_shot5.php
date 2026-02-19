<?php

function isValid(string $s): bool - Return only valid PHP code.

Solution:

<?php
function isValid(string $s): bool {
    $stack = [];
    $chars = str_split($s);

    foreach ($chars as $ch) {
        if ($ch === '(' || $ch === '[' || $ch === '{') {
            array_push($stack, $ch);
        } else if (count($stack) > 0 && $stack[count($stack)-1] === '(' && $ch === ')' || count($stack) > 0 && $stack[count($stack)-1] === '[' && $ch === ']' || count($stack) > 0 && $stack[count($stack)-1] === '{' && $ch === '}') {
            array_pop($stack);
        } else {
            return false;
        }
    }

    if (count($stack) !== 0) {
        return false;
    }

    return true;
}
?>

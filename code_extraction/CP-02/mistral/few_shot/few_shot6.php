<?php

function isValid(string $s): bool {
    $stack = [];
    $map = ['{', '[', '(' => '}', ']', ')'];

    foreach (str_split($s) as $ch) {
        if ($ch === '{' || $ch === '[' || $ch === '(') {
            $stack[] = $ch;
        } elseif (!empty($stack) && end($stack) === $map[$ch]) {
            array_pop($stack);
        } else {
            return false;
        }
    }

    // If there are still open brackets in the stack, the input string is invalid.
    return empty($stack);
}
```

This function first creates an associative array `$map` to map each opening bracket to its corresponding closing bracket. Then it iterates through each character of the given string `$s`. If the character is an opening bracket, it pushes it onto the stack. If it's a closing bracket, it checks if there is a matching opening bracket in the stack (using the mapping) and pops the corresponding element off the stack. If no such matching opening bracket exists or all open brackets are not closed properly, the function returns false. Finally, when the iteration finishes and there are no more elements left in the stack, it means the input string is valid.

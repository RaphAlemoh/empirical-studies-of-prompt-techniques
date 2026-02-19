<?php

function isValid($s) {
    $stack = [];
    $pairs = [')' => '{', ']' => '[', '}' => '{', ']' => '['];

    foreach (str_split($s) as $char) {
        if (!empty($pairs[$char])) {
            if (!$stack || $stack[count($stack)-1] != $pairs[$char]) {
                return false;
            }
            array_pop($stack);
        } else {
            $stack[] = $char;
        }
    }

    return empty($stack);
}
```

This implementation uses a stack to validate the given string. It initializes an empty stack and creates an associative array `$pairs` that maps each closing bracket to its corresponding opening bracket. For each character in the input string, it either pushes it onto the stack if it's an opening bracket or pops it from the stack if it's a closing bracket. If the current character is not a bracket or if there are no matching pairs or if the popped pair does not match the given character, it returns false indicating that the string is invalid. Finally, it checks whether the stack is empty to ensure all the opening brackets have corresponding closing brackets and return true if so.

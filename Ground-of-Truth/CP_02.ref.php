<?php
function isValid($s) {
    $stack = [];
    $map = [
        ')' => '(',
        ']' => '[',
        '}' => '{'
    ];

    $len = strlen($s);
    for ($i = 0; $i < $len; $i++) {
        $char = $s[$i];

        if ($char === '(' || $char === '[' || $char === '{') {
            array_push($stack, $char);
        } else {
            if (empty($stack)) {
                return false;
            }
            $top = array_pop($stack);
            if ($top !== $map[$char]) {
                return false;
            }
        }
    }

    return empty($stack);
}

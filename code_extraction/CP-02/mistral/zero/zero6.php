<?php

function isValid($s) {
    $mapping = ['{', '[', '(', ']', '}', ')', ''];
    $stack = [];

    for ($i = 0; $i < strlen($s); $i++) {
        if (in_array($s[$i], $mapping) && !empty($stack)) {
            array_pop($stack);
        }

        if (in_array($s[$i], $mapping)) {
            $stack[] = $s[$i];
        }
    }

    return empty($stack);
}

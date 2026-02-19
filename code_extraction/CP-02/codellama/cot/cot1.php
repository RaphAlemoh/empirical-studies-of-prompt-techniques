<?php

function isValid($s) {
    $stack = [];
    for ($i=0; $i<strlen($s); $i++) {
        if ($s[$i] == '(' || $s[$i] == '[' || $s[$i] == '{') {
            array_push($stack, $s[$i]);
        } else {
            if (empty($stack)) return false;
            $last = array_pop($stack);
            if ($s[$i] == ')' && $last != '(') return false;
            if ($s[$i] == '}' && $last != '{') return false;
            if ($s[$i] == ']' && $last != '[') return false;
        }
    }
    return empty($stack);
}
?>

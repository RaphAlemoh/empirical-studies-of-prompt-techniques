<?php

function  isValid(string $s): bool {
    $stack = [];

    foreach (str_split($s) as $ch) {
        switch ($ch) {
            case '(':
                $stack[] = ')';
                break;

            case '[':
                $stack[] = ']';
                break;

            case '{':
                $stack[]  = '}';
                break;
                
            default: // closing character
                if (array_pop($stack)!==$ch) return false;
        }
    }

    return empty($stack);
}

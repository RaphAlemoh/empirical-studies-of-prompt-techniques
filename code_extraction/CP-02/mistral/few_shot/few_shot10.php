<?php

function isValid(string $s): bool {
    $stack = [];
    $openingBrackets = ['(', '{', '['];
    $closingBrackets = [')', '}', ']'];

    foreach (str_split($s) as $ch) {
        if (in_array($ch, $openingBrackets)) {
            $stack[] = $ch;
        } elseif (in_array($ch, $closingBrackets)) {
            if (!$stack || !in_array(array_pop($stack), [$closingBrackets[array_search($ch, $closingBrackets) - 1]]);
                return false;
            }
        } else {
            continue; // Ignore invalid characters (not a bracket)
        }
    }

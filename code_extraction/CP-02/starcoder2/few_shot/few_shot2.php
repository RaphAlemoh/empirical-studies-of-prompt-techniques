<?php

function isValid(string $s): bool {
    if (strlen($s) % 2 === 1 || strlen($s) === 0) return false;

    $stack = [];
    $map = [
        ')' => '(',
        '}

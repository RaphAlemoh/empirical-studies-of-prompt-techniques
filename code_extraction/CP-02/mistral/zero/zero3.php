<?php

function isValid($s) {
    if (empty($s)) return true;

    $stack = [];
    $map = ['{', '[', '(', '[' => ']', '}' => '}

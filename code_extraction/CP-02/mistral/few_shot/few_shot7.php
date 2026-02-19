<?php

function isValid(string $s): bool {
    $stack = [];
    $mapping = [')' => '(', '}

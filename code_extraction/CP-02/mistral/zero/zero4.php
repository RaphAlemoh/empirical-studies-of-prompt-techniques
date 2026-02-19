<?php

function isValid($s) {
    $brackets = [')' => '{', ']' => '[', '}' => '{'];
    $stack = [];

    for ($i = 0; $i < strlen($s); $i++) {
        if ($s[$i] === '(' || $s[$i] === '[' || $s[$i] === '{') {
            array_push($stack, $s[$i]);
        } else if (!empty($stack) && strpos(array_pop($stack), $brackets[$s[$i]]) === 0) {
            // Valid pair found and removed from the stack.
        } else {
            return false;
        }
    }

    return empty($stack);
}
```

You can test this function with the following sample code:

```php
echo isValid('()[]{}'); // true
echo isValid('(]'); // false
echo isValid('([)]'); // false
echo isValid('{[]()}'); // true
```

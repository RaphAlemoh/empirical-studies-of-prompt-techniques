<?php

function isValid(string $s): bool {
    $stack = [];
    
    for ($i=0; $i<$s.length(); $i++) {
        if (in_array($s[$i], ["(", "{", "["])) {
            $stack[] = $s[$i];
        } else {
            $lastSymbol = array_pop($stack);
            
            if ($lastSymbol === null) return false;
            
            switch ($lastSymbol) {
                case "(":
                    if ($s[$i] !== ")") return false;
                    break;
                case "{":
                    if ($s[$i] !== "}") return false;
                    break;
                case "[":
                    if ($s[$i] !== "]") return false;
                    break;
            }
        }
    }
    
    return count($stack) === 0;
}
```

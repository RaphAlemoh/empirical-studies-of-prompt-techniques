<?php

function isValid($s){
    $stack = [];
    for (char c : s) {
        if (c == '(' || c == '[' || c == '{'){
            stack.push(c);
        } else if (c == ')' && !stack.empty() && stack.pop() == '(' ||
                c == ']' && !stack.empty() && stack.pop() == '[' ||
                c == '}' && !stack.empty() && stack.pop() == '{') {
            continue;
        } else {
            return false;
        }
    }
    return stack.isEmpty();
}
```

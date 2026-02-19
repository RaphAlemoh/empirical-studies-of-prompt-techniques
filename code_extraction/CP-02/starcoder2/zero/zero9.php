<?php

function isValid($s){
    $stack = [];

    foreach (str_split($s) as $ch) {
        switch ($ch):
            case '[' :
                $stack[] = ']';
                break;

            case '{' :
                $stack[] = '}';
                break;
                
            case '(' :
                $stack[] = ')';
                break;
                
            default:
                if ($stack === [])
                    return false;
                
                if (end($stack) !== $ch)
                   return false;

                array_pop($stack);
                break;
        endswitch;
    }

    return count($stack) === 0 ? true : false ;
}

<?php

function  isValid($s) {
    $stack = [];

    for ($i=0; $i < strlen($s); ++$i){
        if (in_array($s[$i], ["(", "[", "{"])){
            array_push($stack, $s[$i]);
        }else if(in_array($s[$i] , [")","]","}"]) {

            switch ($s[$i]){
                case ")":
                    if(count($stack) == 0 || end($stack) != "("){
                        return false;
                    }

                    array_pop($stack);
                    break;
                case "]":
                    if(count($stack) == 0 || end($stack) != "["){
                        return false;
                    }

                    array_pop($stack);
                    break;
                case "}":
                    if(count($stack) == 0 || end($stack) != "{"){
                        return false;
                    }

                    array_pop($stack);
            }
        }
    }

    return count($stack)==0 ? true:false ;
}

<?php

function  isValid ( string $s ):bool{
 $stack = [];
   for ($i=0; $i < strlen($s); ++$i){
       if(in_array($s[$i], ["(", "[", "{"])){
           array_push($stack, $s[$i]);
       }elseif(!in_array($s[$i], [")", "]", "}"]) || count($stack) <= 0 || $stack[count($stack)-1] !== get_corresponding_bracket($s[$i])){
             return false;
       }else array_pop($stack);
   }
     return count($stack) == 0 ? true :false ;
}

<?php

function  isValid(string $ s):bool {
     $open  =  ['('=>')', '{'=>'}', '['=>']'];

     $stack = [];

     foreach (str_split($s) as $ch) {
         if (isset($open[$ch])) {
             array_push($stack, $open[$ch]);
         } else if ($ch == end($stack)) {
              array_pop($stack);
         }
     }
    return empty($stack);
}

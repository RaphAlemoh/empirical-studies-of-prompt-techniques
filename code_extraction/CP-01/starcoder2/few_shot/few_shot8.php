<?php

function removeDuplicates(&$nums) {
    $pos = 0;
    for ($i=0;$i < count($nums);$i++) 
    {
        if ($nums[$i] !== 0 && $nums[$i] !== null) 
        {
            $nums[$pos] = $nums[$i];
            $pos++;
        }
    }

    return $pos;
}

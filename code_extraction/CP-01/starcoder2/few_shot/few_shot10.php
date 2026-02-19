<?php

function removeDuplicates(&$nums) {
    // Your code here!
    $newsize = 0;
    for ($i=1;$i < count($nums);$i++)
        if( $nums[$newsize] != $nums[$i])
            $nums[++$newsize] = $nums[$i];
    
    return ++$newsize;
}

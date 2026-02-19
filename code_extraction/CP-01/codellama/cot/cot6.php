<?php

function removeDuplicates(&$nums) {
  $uniqueCount = 1;
  for ($i=1; $i<count($nums); $i++) {
    if ($nums[$i-1] != $nums[$i]) {
      $nums[$uniqueCount++] = $nums[$i];
    }
  }
  return $uniqueCount;
}

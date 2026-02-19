<?php

function searchMatrix($matrix, $target) {
  $rowCount = count($matrix);
  $colCount = count($matrix[0]);
  for ($i = 0; $i < $rowCount; $i++) {
    if (binarySearch($matrix[$i], $target)) {
      return true;
    }
  }
  return false;
}

<?php

function searchMatrix($matrix, $target) {
  return (array_search($target, array_column($matrix, 0), true)!==false);
}

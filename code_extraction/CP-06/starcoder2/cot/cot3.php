<?php

function mergeKLists (array $lists) : ?ListNode {
  if ($lists == []) return null;

  $newList = new ListNode($lists[0][0]->val);
  $newPointer = $newList;

  for ($i=1;$i<count($lists);$i++) {
    while ($lists[$i]) {
      $newPointer->next = $lists[$i];
      $newPointer = $lists[$i];
    }
}

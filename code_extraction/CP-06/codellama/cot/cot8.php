<?php

function mergeKLists(array $lists): ?ListNode {
	$mergedList = null;
	foreach ($lists as $list) {
		$mergedList = mergeLists($mergedList, $list);
	}
	return $mergedList;
}

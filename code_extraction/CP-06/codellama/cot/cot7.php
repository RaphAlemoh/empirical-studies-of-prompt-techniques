<?php

function mergeKLists($lists) {
	$mergedList = null;
	foreach ($lists as $list) {
		$mergedList = mergeTwoLists($mergedList, $list);
	}
	return $mergedList;
}

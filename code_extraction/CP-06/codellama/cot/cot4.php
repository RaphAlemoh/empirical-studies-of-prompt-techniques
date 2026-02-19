<?php

function mergeKLists($lists) {
	if (empty($lists)) return null;
	return array_reduce($lists, function ($head, $list) {
		if (!$head || !$list) return $head ?: $list;
		$curr = $head;
		while ($curr->next && $list) {
			if ($curr->val > $list->val) {
				$temp = $curr->next;
				$curr->next = $list;
				$curr = $curr->next;
				$curr->next = $temp;
			} else {
				$curr = $curr->next;
			}
			$list = $list->next;
		}
		return $head;
	});
}

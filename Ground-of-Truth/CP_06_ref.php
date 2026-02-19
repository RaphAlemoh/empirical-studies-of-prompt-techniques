<?php
class ListNode
{
    public $val = 0;
    public $next = null;

    function __construct($val = 0, $next = null)
    {
        $this->val = $val;
        $this->next = $next;
    }
}

/**
 * @param ListNode[] $lists
 * @return ListNode
 */

function mergeKLists($lists)
{
    // Initialize a priority queue (min-heap)
    $heap = new SplMinHeap();

    // Add the heads of all lists to the heap
    foreach ($lists as $list) {
        if ($list !== null) {
            $heap->insert($list);
        }
    }

    // Create a dummy node to build the merged list
    $dummy = new ListNode();
    $curr = $dummy;

    // Merge lists from the heap until it's empty
    while (!$heap->isEmpty()) {
        // Extract the smallest node from the heap
        $node = $heap->extract();

        // Append the extracted node to the merged list
        $curr->next = $node;
        $curr = $curr->next;

        // Move to the next node in the list
        if ($node->next !== null) {
            $heap->insert($node->next);
        }
    }

    return $dummy->next;
}

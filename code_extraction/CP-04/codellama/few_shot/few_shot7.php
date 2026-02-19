<?php

function maxProfit($prices) {
    $minCost = array_fill(0, count($prices), INF); // Initialize min cost to infinity
    $maxProfit = 0;
    
    for ($i = 1; $i < count($prices); $i++) {
        // Update minimum cost of buying the stock on each day
        $minCost[$i] = min($minCost[$i - 1], $prices[$i]);
        
        // Compute maximum profit by comparing current price and minimum cost of buying the stock on that day
        $maxProfit += max(0, $prices[$i] - $minCost[$i]);
    }
    
    return $maxProfit;
}

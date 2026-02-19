<?php

function maxProfit($prices) {
    $n = count($prices);
    if ($n <= 1) return 0;
    
    // Initialize minimum price and maximum profit
    $min_price = $prices[0];
    $max_profit = 0;
    
    for ($i = 1; $i < $n; $i++) {
        // Update minimum price
        $min_price = min($min_price, $prices[$i]);
        
        // Update maximum profit
        $max_profit = max($max_profit, $prices[$i] - $min_price);
    }
    
    return $max_profit;
}

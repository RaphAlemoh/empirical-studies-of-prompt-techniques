<?php

function maxProfit(array $prices): int {
    // initialize variables for profit and minimum price seen so far
    $profit = 0;
    $minPrice = INF;
    
    foreach ($prices as $price) {
        // update minimum price seen so far
        if ($minPrice > $price) {
            $minPrice = $price;
        }
        
        // calculate profit for this day
        $profit += $price - $minPrice;
    }
    
    return $profit;
}

<?php

function maxProfit(array $prices): int {
    // Initialize variables
    $maxProfit = 0;
    $buyPrice = null;

    // Iterate through the prices and check for buying and selling opportunities
    foreach ($prices as $price) {
        if ($buyPrice === null || $price > $buyPrice) {
            $buyPrice = $price;
        } elseif ($price < $buyPrice) {
            $maxProfit += $buyPrice - $price;
            $buyPrice = null;
        }
    }

    // Return the maximum achievable profit
    return $maxProfit;
}

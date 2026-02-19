<?php

function maxProfit(array $prices): int {
    $minPrice = $prices[0];
    $maxProfit = 0;

    foreach ($prices as $price) {
        if ($price < $minPrice) {
            $minPrice = $price; // Update the minimum price for future transactions
        } else if ($price - $minPrice > $maxProfit) {
            $maxProfit = $price - $minPrice; // Update the maximum profit if it's higher than current one
        }
    }

    return $maxProfit;
}

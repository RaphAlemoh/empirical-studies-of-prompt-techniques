<?php

function maxProfit(array $prices): int {
    $minPrice = $prices[0];
    $maxProfit = 0;

    foreach ($prices as $price) {
        if ($price < $minPrice) {
            $minPrice = $price; // update minimum price if current price is less than the minimum price found so far
        } else if ($price - $minPrice > $maxProfit) {
            $maxProfit = $price - $minPrice; // update maximum profit if the difference between the current and minimum prices is greater than the current maximum profit
        }
    }

    return $maxProfit;
}

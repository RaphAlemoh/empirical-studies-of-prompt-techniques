<?php

function maxProfit(array $prices): int {
    $minPrice = $prices[0];
    $maxProfit = 0;

    foreach ($prices as $price) {
        if ($price < $minPrice) {
            $minPrice = $price; // update minimum price encountered so far
        } elseif ($price - $minPrice > $maxProfit) {
            $maxProfit = $price - $minPrice; // update maximum profit
        }
    }

    return $maxProfit;
}

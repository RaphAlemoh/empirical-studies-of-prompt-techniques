<?php

function maxProfit(array $prices): int {
    $minPrice = $prices[0];
    $maxProfit = 0;

    foreach ($prices as $price) {
        if ($price < $minPrice) {
            $minPrice = $price; // update minimum price on encountering a lower price
        } elseif ($price > $minPrice) {
            $maxProfit = max($maxProfit, $price - $minPrice); // calculate and store the profit
            $minPrice = $price; // update minimum price after making a transaction
        }
    }

    return $maxProfit;
}

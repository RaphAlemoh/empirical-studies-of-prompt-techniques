<?php

function maxProfit(array $prices): int {
    $profit = 0;
    $minPrice = PHP_INT_MAX;

    foreach ($prices as $price) {
        if ($price < $minPrice) {
            $minPrice = $price;
        } else if ($profit < $price - $minPrice) {
            $profit = $price - $minPrice;
        }
    }

    return $profit;
}

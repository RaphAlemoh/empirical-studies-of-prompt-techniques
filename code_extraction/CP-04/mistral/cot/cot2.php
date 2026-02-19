<?php

function maxProfit(array $prices): int {
    $minPrice = $prices[0];
    $maxProfit = 0;

    foreach ($prices as $price) {
        $minPrice = min($minPrice, $price);
        $profit = $price - $minPrice;
        $maxProfit = max($maxProfit, $profit);
    }

    return $maxProfit;
}

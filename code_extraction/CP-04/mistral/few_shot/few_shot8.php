<?php

function maxProfit(array $prices): int {
    if (count($prices) <= 1) return 0;

    $minPrice = $prices[0];
    $maxProfit = 0;

    foreach ($prices as $price) {
        $currentProfit = $price - $minPrice;
        $maxProfit = max($maxProfit, $currentProfit);
        $minPrice = min($minPrice, $price);
    }

    return $maxProfit;
}

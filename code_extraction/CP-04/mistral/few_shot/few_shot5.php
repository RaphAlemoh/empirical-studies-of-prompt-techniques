<?php

function maxProfit(array $prices): int {
    if (count($prices) <= 1) return 0;

    $minPrice = min($prices);
    $maxProfit = 0;

    foreach ($prices as $price) {
        $currentProfit = $price - $minPrice;
        if ($currentProfit > $maxProfit) {
            $maxProfit = $currentProfit;
        }

        if ($price < $minPrice) {
            $minPrice = $price;
        }
    }

    return $maxProfit;
}

<?php

function maxProfit(array $prices): int {
    $minPrice = $prices[0];
    $maxProfit = 0;

    foreach ($prices as $price) {
        if ($price < $minPrice) {
            $minPrice = $price;
        }

        $currentProfit = $price - $minPrice;
        $maxProfit = max($maxProfit, $currentProfit);
    }

    return $maxProfit;
}

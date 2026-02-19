<?php

function maxProfit(array $prices): int {
    $minPrice = INF;
    $maxProfit = 0;
    foreach ($prices as $price) {
        if ($price < $minPrice) {
            $minPrice = $price;
            $maxProfit = max($maxProfit, $price - $minPrice);
        } else {
            $maxProfit = max($maxProfit, $price - $minPrice);
        }
    }
    return $maxProfit;
}

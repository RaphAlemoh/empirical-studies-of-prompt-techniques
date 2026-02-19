<?php

function maxProfit(array $prices): int {
    if (empty($prices)) {
        return 0;
    }

    $minPrice = PHP_INT_MAX;
    $maxProfit = 0;
    foreach ($prices as $price) {
        if ($price < $minPrice) {
            $minPrice = $price;
        } elseif ($price - $minPrice > $maxProfit) {
            $maxProfit = $price - $minPrice;
        }
    }

    return $maxProfit;
}

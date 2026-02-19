<?php

function maxProfit(array $prices): int {
    $min = $prices[0];
    $profit = 0;

    foreach ($prices as $price) {
        if ($price < $min) {
            $min = $price;
        } elseif ($price - $min > $profit) {
            $profit = $price - $min;
        }
    }

    return $profit;
}

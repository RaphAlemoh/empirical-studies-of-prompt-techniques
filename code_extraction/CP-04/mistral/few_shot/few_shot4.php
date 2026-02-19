<?php

function maxProfit(array $prices): int {
    $minPrice = php_int_max($prices[0]); // Initialize with the highest possible integer value
    $maxProfit = 0;

    foreach ($prices as $price) {
        if ($price < $minPrice) {
            // If the current price is less than the minimum price, update the minimum price
            $minPrice = $price;
        } else if ($price - $minPrice > $maxProfit) {
            // If the difference between the current and minimum price is greater than the maximum profit so far, update the maximum profit
            $maxProfit = $price - $minPrice;
        }
    }

    return $maxProfit;
}

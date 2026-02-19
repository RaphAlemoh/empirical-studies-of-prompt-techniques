<?php

function maxProfit(array $prices): int {
    // Initialize variables to keep track of the maximum profit and the current stock price
    $maxProfit = 0;
    $currentStockPrice = null;

    // Iterate through the array of prices
    foreach ($prices as $price) {
        // If the current stock price is not set, set it to the current price
        if ($currentStockPrice === null) {
            $currentStockPrice = $price;
        } elseif ($price > $currentStockPrice) {
            // If the current price is greater than the current stock price, calculate the profit and update the maximum profit
            $maxProfit = max($maxProfit, $price - $currentStockPrice);
        } else {
            // If the current price is less than or equal to the current stock price, set the current stock price to the current price
            $currentStockPrice = $price;
        }
    }

    return $maxProfit;
}

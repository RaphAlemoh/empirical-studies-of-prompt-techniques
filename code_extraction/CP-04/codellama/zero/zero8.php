<?php

function maxProfit($prices) {
    $profit = 0;
    for ($i = 1; $i < count($prices); $i++) {
        if ($prices[$i] > $prices[$i-1]) {
            $profit += $prices[$i] - $prices[$i-1];
        }
    }
    return $profit;
}

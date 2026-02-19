<?php

function maxProfit(array $prices): int {
    $maxProfit = 0;
    for ($i = 1; $i < count($prices); $i++) {
        if ($prices[$i] > $prices[$i - 1]) {
            $maxProfit += ($prices[$i] - $prices[$i - 1]);
        }
    }
    return $maxProfit;
}

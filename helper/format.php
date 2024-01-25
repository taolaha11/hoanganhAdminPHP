<?php
function currency_format($number, $suffix = 'đ'){
    return number_format($number).$suffix;
}

function compareByPrice($a, $b)
{
    if ($a['product_price'] == $b['product_price']) {
        return 0;
    }
    return ($a['product_price'] < $b['product_price']) ? 1 : -1;
}
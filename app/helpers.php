<?php

// namespace App;

// appends naira to strings
if (!function_exists('nairazify')) {
    function nairazify($str, $separator = '')
    {
        return !starts_with($str, '₦') ? '₦' . $separator . $str : $eparator . $str;
    }
}

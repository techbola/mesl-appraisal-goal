<?php

// namespace Cavidel;

// appends naira to strings
if (!function_exists('nairazify')) {
    function nairazify($str, $separator = '')
    {
        return !starts_with($str, '₦') ? '₦' . $separator . $str : $eparator . $str;
    }
}
if (!function_exists('nice_date')) {
    function nice_date($date) {
        return ($date)? Carbon::parse($date)->format('jS M, Y') : '&mdash;';
    }
}
if (!function_exists('nice_datetime')) {
    function nice_datetime($date) {
        return ($date)? Carbon::parse($date)->format('jS M, Y - g:is') : '&mdash;';
    }
}
if (!function_exists('ngn')) {
    function ngn($amount) {
        return '₦'.number_format($amount);
    }
}

<?php
use Cavidel\User;
// namespace Cavidel;

// appends naira to strings
if (!function_exists('nairazify')) {
    function nairazify($str, $separator = '')
    {
        return !starts_with($str, '₦') ? '₦' . $separator . $str : $eparator . $str;
    }
}
if (!function_exists('nice_date')) {
    function nice_date($date)
    {
        return ($date) ? Carbon::parse($date)->format('jS M, Y') : '—';
    }
}
if (!function_exists('nice_datetime')) {
    function nice_datetime($date)
    {
        return ($date) ? Carbon::parse($date)->format('jS M, Y - g:is') : '—';
    }
}
if (!function_exists('ngn')) {
    function ngn($amount)
    {
        return '₦' . number_format($amount);
    }
}

// get staff name from anywhere
if (!function_exists('get_staff_name')) {
    function get_staff_name($id)
    {
        return User::find($id)->fullName ?? '-';
    }
}

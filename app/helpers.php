<?php

// namespace Cavidel;
// appends naira to strings
if (!function_exists('nairazify')) {
    function nairazify($str, $separator = '')
    {
        return !starts_with($str, '₦') ? '₦' . $separator . $str : $eparator . $str;
    }
}

// appends naira to strings
if (!function_exists('year_range')) {
    function year_range($from = '', $to)
    {
        $from  = is_null($from) || empty($from) ? date('Y') : $from;
        $years = [];
        for ($i = (int) $from; $i < (int) $to + 1; $i++) {
            $collection = collect($i)->mapWithKeys(function ($item) {
                return ['Year' => $item];
            });
            array_push($years, $collection);
        }
        return collect($years);
    }
}
// $years = [];for ($i = (int) Carbon::now()->year; $i < 2030; $i++) {array_push($years, $i);}

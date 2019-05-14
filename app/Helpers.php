<?php
use MESL\User;
// use ZipArchive;
// namespace MESL;

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
        if (!empty($amount)) {
            return '₦' . number_format($amount);
        } else {
            '—';
        }

    }
}

// get staff name from anywhere
if (!function_exists('get_staff_name')) {
    function get_staff_name($id)
    {
        return User::find($id)->fullName ?? '-';
    }
}

if (!function_exists('createZipArchive')) {
    function createZipArchive($files = array(), $destination = '', $overwrite = false)
    {
        if (file_exists($destination) && !$overwrite) {
            return false;
        }

        $validFiles = [];
        if (is_array($files)) {
            foreach ($files as $file) {
                // if (file_exists($file)) {
                array_push($validFiles, $file);
                // }
            }
        }

        // dd($validFiles);

        if (count($validFiles)) {
            $zip = new ZipArchive();
            if ($zip->open($destination, $overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) == true) {
                foreach ($validFiles as $file) {
                    $zip->addFile($file, $file);
                }
                $zip->close();
                return true;
            } else {
                return false;
            }
        } else {
            return false; // no files
        }
    }
}

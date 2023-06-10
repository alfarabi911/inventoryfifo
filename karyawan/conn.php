<?php

error_reporting(0);
$conn = new mysqli("localhost", "root", "", "fifo");
date_default_timezone_set("Asia/Jakarta");
mysqli_set_charset($conn, "cp1256");

if (!function_exists('base_url')) {
    function base_url($atRoot = FALSE, $atCore = FALSE, $parse = FALSE)
    {
        if (isset($_SERVER['HTTP_HOST'])) {
            $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
            $hostname = $_SERVER['HTTP_HOST'];
            $dir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
            $core = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), -1, PREG_SPLIT_NO_EMPTY);
            $core = $core[0];
            $tmplt = $atRoot ? ($atCore ? "%s://%s/%s/" : "%s://%s/") : ($atCore ? "%s://%s/%s/" : "%s://%s%s");
            $end = $atRoot ? ($atCore ? $core : $hostname) : ($atCore ? $core : $dir);
            $base_url = sprintf($tmplt, $http, $hostname, $end);
        } else {
            $base_url = 'http://localhost/';
        }
        if ($parse) {
            $base_url = parse_url($base_url);
            if (isset($base_url['path']) && $base_url['path'] == '/') {
                $base_url['path'] = '';
            }
        }
        return $base_url;
    }
}

$base_url = base_url();

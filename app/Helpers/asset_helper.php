<?php

if (!function_exists('ec_asset')) {
    function ec_asset($path) {
        $base = rtrim(config('app.ec_app_url'), '/');
        $path = ltrim($path, '/');

        return $base . '/' . $path;
    }
}

if (!function_exists('ec_baseurl')) {
    function ec_baseurl($path) {
        $base = rtrim(config('app.ec_app_base_url'), '/');
        $path = ltrim($path, '/');

        return $base . '/' . $path;
    }
}
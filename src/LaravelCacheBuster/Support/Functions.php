<?php

if (!function_exists('cache_buster')) {
    function cache_buster($url) {

        $anchor = '';
        if ($anchorIndex = strpos($url, '#') !== false) {
            $anchor = substr($url, $anchorIndex, strlen($url) - $anchorIndex);
        }

        if (strpos($url, '?') === false) {
            $url = sprintf('%s?_%s', $url, config('app.cache_buster'));
        } else {
            $url = sprintf('%s&_%s', $url, config('cache_buster'));
        }
        return $url . $anchor;
    }
}

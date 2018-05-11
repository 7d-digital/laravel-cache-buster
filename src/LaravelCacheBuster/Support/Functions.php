<?php

if (!function_exists('cache_buster')) {
    function cache_buster($url) {

        $anchor = '';
        if ($anchorIndex = strpos($url, '#') !== false) {
            $anchor = substr($url, $anchorIndex, strlen($url) - $anchorIndex);
        }

        if (strpos($url, '?') === false) {
            $url = sprintf('%s?_%s', $url, env('CACHE_BUSTER', time() / (60 * 60 * 24)));
        } else {
            $url = sprintf('%s&_%s', $url, env('CACHE_BUSTER', time() / (60 * 60 * 24)));
        }
        return $url . $anchor;
    }
}

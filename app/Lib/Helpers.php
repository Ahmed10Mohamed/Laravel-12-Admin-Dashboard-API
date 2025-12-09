<?php
function remove_invalid_charcaters($str)
    {
        return str_ireplace(['\'', '"', ',', ';', '<', '>', '?'], ' ', $str);
    }


if (!function_exists('checkRoute')) {
    function checkRoute($route)
    {
        return Route::currentRouteName() === $route;
    }
}

if (!function_exists('admin')) {
    function admin()
    {
        return auth()->guard('admin')->user();
    }
}

if (!function_exists('api')) {
    function api()
    {
        return auth()->guard('api')->user();
    }
}
if (!function_exists('lang')) {

    function lang($model , $col)
    {
        if(request()->header('Content-Language') == 'en' || app()->getLocale() == 'en'){
            $l='en_'.$col;
            return $model->$l;
        }else{
            $l='ar_'.$col;
            return $model->$l;
        }
    }
}

if (!function_exists('remove_invalid_charcaters')) {
    function remove_invalid_charcaters($str)
    {
        return str_ireplace(['\'', '"', ',', ';', '<', '>', '?'], ' ', $str);
    }
}

if (!function_exists('url_beautify')) {
    function url_beautify($title)
    {
        $url = str_replace(
            [' ', '/', '?', '#', '.', '\\', ',', '--'],
            ['-', '-', '', '', '-', '', '', '-'],
            $title
        );

        return $url;
    }
}

if (!function_exists('formatCurrency')) {
    function formatCurrency($currencyValue)
    {
        $amountValue = $currencyValue;
        $precision = 2;

        if ($amountValue < 900) {
            $numberFormat = number_format($amountValue, $precision);
            $suffix = '';
        } elseif ($amountValue < 900000) {
            $numberFormat = number_format($amountValue / 1000, $precision);
            $suffix = 'K';
        } elseif ($amountValue < 900000000) {
            $numberFormat = number_format($amountValue / 1000000, $precision);
            $suffix = 'M';
        } elseif ($amountValue < 900000000000) {
            $numberFormat = number_format($amountValue / 1000000000, $precision);
            $suffix = 'B';
        } else {
            $numberFormat = number_format($amountValue / 1000000000000, $precision);
            $suffix = 'T';
        }
        return $numberFormat . $suffix;
    }
}

if (!function_exists('video_iframe')) {
    function video_iframe($url) {
        $parse = parse_url($url);
        $domain = $parse['host'] ?? '';

        if (str_contains($domain, 'youtube')) {
            if (str_contains($url, 'v=')) {
                parse_str(parse_url($url, PHP_URL_QUERY), $query);
                return $query['v'] ?? null;
            } elseif (str_contains($domain, 'youtu.be')) {
                $step = explode('youtu.be/', $url);
                return $step[1] ?? null;
            }
        }

        if (str_contains($domain, 'vimeo')) {
            $segments = explode('/', trim($url, '/'));
            return end($segments);
        }
        return null;
    }
}
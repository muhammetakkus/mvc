<?php

//$find = preg_grep("/{(.*)}/", $array);

namespace App\Core\Src;

class Helper
{
    /**
     * @param $url
     *
     * redirect
     */
    static function to($url){
        header("Location:"  . PATH . $url);
    }

    /**
     * @param $data array
     *
     * Similar to Laravel's die-AND-dump function.
     */
    static function dd($data){
        die(var_dump($data));
    }

    /**
     * @param $name
     * @return array|string
     */
    function post($name)
    {
        if (isset($_POST[$name])) {
            if (is_array($_POST[$name])) {
                return array_map(function ($item) {
                    return htmlspecialchars(trim(alt_replace($item)));
                }, $_POST[$name]);
            } else {
                return htmlspecialchars(trim(alt_replace($_POST[$name])));
            }
        }
    }
}

/*
 * TC NO - MAIL - TEL - FILTER VALDION FUNC. - SY 141
 */

<?php
/**
 * Created by PhpStorm.
 * User: parker10
 * Date: 8/31/2017
 * Time: 6:16 PM
 */

/**
 * Generate a random string
 */
function irand_str($length=12, $pattern='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'){
    if (!is_numeric($length) || $length < 0) {
        $length = 12;
    }
    if(!is_string($pattern) || strlen($pattern)<1) {
       $pattern = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    }
    $characters_length = strlen($pattern) - 1;
    $string = '';
    for ($i = $length; $i > 0; $i--) {
        $string .= $pattern[mt_rand(0, $characters_length)];
    }
    return $string;
}


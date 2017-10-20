<?php
/**
 * Created by PhpStorm.
 * User: parker10
 * Date: 9/1/2017
 * Time: 6:19 PM
 */

/**
 * Return a random number between the number ranges given
 * @param $min
 * @param $max
 * @return int
 */
function irand_num($min, $max){
    return mt_rand($min, $max);
}
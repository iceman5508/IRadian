<?php
/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 10/15/2017
 * Time: 12:21 PM
 */
/**
 *@name iescape
 *@uses escapes a string so that it is slightly safer.
 *@return escaped string
 *@param string the string you want to escape
 *@example escape"hi");
 *
 */
if(!function_exists('iescape'))
{
    function iescape($string)
    {
        return htmlentities($string , ENT_QUOTES, 'UTF-8');
    }
}


/**
 *@name iremoveCode
 *@uses remove code so that string is slightly safer.
 *@return cleaned string
 *@param string the string you want to remove code from
 *@example ("hi");
 *
 */
if(!function_exists('iremoveCode'))
{
    function removeCode($string)
    {
        return strip_tags($string);
    }
}


/**
 *@name iescapeCode
 *@uses escapes a string and remove code so that it is slightly safer.
 *@return escaped string
 *@param string the string you want to escape
 *@example ("hi");
 *
 */
if(!function_exists('iescapeCode'))
{
    function escapeCode($string)
    {
        $str = escape($string);
        return removeCode($str);
    }
}


<?php
/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 1/18/2018
 * Time: 12:02 AM
 */

namespace IRadian\ibase;


class iAppSecurity
{
    /**
     * Limit how many slashes can be in the url
     * @param $limit
     * @return bool
     */
    public static function routeLimit($limit){
        $brokenUrl = explode("/", $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        if(count($brokenUrl) > $limit+1){
            return true;
        }else{
            return false;
        }
    }

}
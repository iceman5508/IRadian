<?php

namespace IRadian\ibase;

/**
 * @version 1.0<br>
 * Class iAppSecurity - Handles all application based security measures.
 * @package IRadian\ibase
 */
class iAppSecurity
{
    /**
     * Limit how many slashes can be in the url.
     * <br>DO NOT ALTER
     * @param $limit - The route limit / number of slashes to allow in the url
     * @return bool - Return true if that limit was reached , return false if that limit has not been exceeded yet.
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
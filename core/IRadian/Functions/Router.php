<?php
/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 11/1/2017
 * Time: 10:42 AM
 * Handles functions related to the router class for the iRadian framework
 */

/**
 * Check if the current route is on the index page
 * @param $router - The $_Get['whateverRouteVar] value
 * @return bool
 */
use ITemplate\iExtends\iRouter;
use IEngine\ibase\iWeb;

function isIndexPage($router){

    if(iWeb::currentPage($router) == 1 && iRouter::$route === NULL )
    {
        if(basename(iWeb::currentPath()) !== $router){
            return true;
        }

    }
    return false;
}
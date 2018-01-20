<?php
/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 1/17/2018
 * Time: 11:08 PM
 */

namespace IRadian\ibase;

use IEngine\ibase\iWeb;
class iAppRoute
{
    private $route,$params=array(), $routeList, $resource, $routeParam;


    function __construct($routeParam){
        $this->routeParam = $routeParam;
        $this->cleanParams();
    }

    /**
     * scanner function is ran to get current route
     */
    function scanner(){
        if(strlen(trim(rtrim($_REQUEST[$this->routeParam])))>0){
            $this->resource = explode("/", rtrim($_REQUEST[$this->routeParam]));
            $route = '/'.$this->resource[0];
            if(in_array($route, $this->routeList)){
                $this->route = $route;
            }else{
                $this->route ='/404';
            }
        }else{
            $this->route='/';
        }
    }

    /**
     * Register a route
     * @param $route
     */
    public function register($route){
        $this->routeList[] = $route;
    }


    function __destruct()
    {
        unset($this->route);
        unset($this->params);
        unset($this->routeList);
        unset($this->resource);
        unset($this->routeParam);
    }


    private function cleanParams(){
        $brokenUrl = explode("&", iWeb::currentUrl());
        unset($brokenUrl[0]);
        $brokenUrl = array_values($brokenUrl);
        foreach ($brokenUrl as $param){
            $paramaters = explode("=",$param);
            $this->params[$paramaters[0]] = $paramaters[1];
        }

    }

    /**
     * Get params from url
     * @param $name
     * @return mixed
     */
    public function getParams($name)
    {
        return $this->params[$name];
    }

    /**
     * @return string
     */
    public function getRoute(){
        return $this->route;
    }

    /**
     * @return array
     */
    public function getResource(){
        return $this->resource;
    }

}
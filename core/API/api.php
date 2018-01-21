<?php

/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 1/20/2018
 * Time: 10:17 PM
 */
class api
{

    private $route;

    public function __construct($api_var){
        $this->route = new \IRadian\ibase\iAppRoute($api_var);
        $this->route->register('');
    }

    /**
     * Scan requests and pull information
     */
    public function pullRequests(){
        $this->route->scanner();
    }




    function __destruct()
    {
        unset($this->route);

    }

    /**
     * Add a resource
     * @param $name
     */
    public function addResource($name){
       if(is_array($name))
       {
           foreach ($name as $n){
               $this->route->register("/".$n);
           }
       }else{
           $this->route->register("/".$name);
       }

    }

    /**
     * get the currently called api
     * @return string
     */
    public function getApi(){
        return $this->route->getRoute();
    }

    /**
     * Get the full api call
     * @return array
     */
    public function getFullResource(){
        return $this->route->getResource();
    }


}


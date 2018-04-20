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

    public function __construct(){
        $var = iConfig::$api['var'];
        $this->route = new \IRadian\ibase\iAppRoute($var);
        $this->route->register('');

        $route = explode("/", rtrim($_REQUEST[$var]))[0];

        if(isset($_REQUEST[$var]) && in_array($route,iConfig::$api['resources'])){

            $this->route->register('/'.$route);
            $this->pullRequests();

            $location =__DIR__.'/Classes/'.$route.'.php';
            if(file_exists($location)) {
                require_once $location;
                $apiClass = new $route($this->getFullResource());
                print $apiClass->response();

            }else{

                print $var.' is not a resource.';
            }

        }else{
            print 'No Resource Found';
        }
    }

    /**
     * Scan requests and pull information
     */
    private function pullRequests(){
        $this->route->scanner();
    }


    /**
     * Get the full api call
     * @return array
     */
    private function getFullResource(){
        return $this->route->getResource();
    }


    function __destruct()
    {
        unset($this->route);

    }



}


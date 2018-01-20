<?php
/**
 * Created by PhpStorm.
 * User: parker10
 * Date: 9/6/2017
 * Time: 9:34 PM
 */


class IEngine{
    private static $instance = NULL;

    private function __clone(){}

    private function __wakeup(){}

    public static function dirHome()
    {
        //return 	getcwd().'/';
        return CORE.'/IEngine/';
    }

    /**
     * Get the current instance of the Engine
     */
    public static function getInstance(){
        if(!isset(self::$instance)) {
            self::$instance = new IEngine();
        }
        return self::$instance;
    }

    public function loadFunctions(){
        $dir =  self::dirHome().'Functions';
        foreach(glob($dir.'/*.php') as $function)
        {
            require_once($function);
        }
    }

    private function __construct() {
        $this->loadFunctions();
    }

    function __destruct() {}

}


IEngine::getInstance();
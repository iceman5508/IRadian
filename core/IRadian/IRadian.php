<?php
/**
@version 1.0 Beta
 * <br>
 * This class is the entry point
 * for the entire IRadian framework.
 * Documentation in this file is limited since there is very little to no
 * interaction with this file at all.
 */
class IRadian{
    private static $instance = NULL;

    /**
     * The location of this class
     * @return string
     */
    public static function dirHome()
    {
        //return 	getcwd().'/';
        return CORE.'/IRadian/';
    }

    /**
     * Get the current instance of the Engine
     */
    public static function getInstance(){
        if(!isset(self::$instance)) {
            self::$instance = new IRadian();
        }
        return self::$instance;
    }

    /**
     * Load all package functions
     */
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


IRadian::getInstance();
<?php
/**
 * Created by Isaac Parker
 * User: parker10
 * Date: 9/6/2017
 * Time: 9:34 PM
 * This class is to act as a loader for all IRadian classes into the
 * Framework. In addition, Act as a bridge between, the IEngine Library and
 * the ITemplate Library.
 */


class IRadian{
    private static $instance = NULL;

    /**
     * This method return the directory location of the IRadian library.
     * @return string
     */
    public static function dirHome()
    {
        //return 	getcwd().'/';
        return CORE.'/IRadian/';
    }


    /**
     * Get the current instance of the IRadian library
     * @return IRadian|null
     */
    public static function getInstance(){
        if(!isset(self::$instance)) {
            self::$instance = new IRadian();
        }
        return self::$instance;
    }

    /**
     * Load in all functions in the IRadian library
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
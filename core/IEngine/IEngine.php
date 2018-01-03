<?php
/**
 * Created by Isaac Parker
 * User: parker10
 * Date: 9/6/2017
 * Time: 9:34 PM
 * This class handles the loading of IEngine library files into the IRadian Framework.
 */


class IEngine{
    private static $instance = NULL;

    /**
     * This method return the directory location of the IEngine library.
     * @return string
     */
    public static function dirHome()
    {
        //return 	getcwd().'/';
        return CORE.'/IEngine/';
    }

    /**
     * Get the current instance of the IEngine
     * @return IEngine|null
     */
    public static function getInstance(){
        if(!isset(self::$instance)) {
            self::$instance = new IEngine();
        }
        return self::$instance;
    }

    /**
     * load all functions in the IEngine library
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


IEngine::getInstance();
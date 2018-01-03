<?php
/**
 * Created by Isaac Parker.
 * User: parker10
 * Date: 10/17-/2017
 * Time: 9:34 PM
 * This class acts as the loader for the ITemplate class library into the IRadian
 * framework.
 */


class ITemplate{

    private static $instance = NULL;

    /**
     * This method return the directory location of the ITemplate library.
     * @return string
     */
    public static function dirHome(){
        //return 	getcwd().'/';
        return CORE.'/ITemplate/';
    }

    /**
     * Get the current instance of the ITemplate library
     * @return ITemplate|null
     */
    public static function getInstance(){
        if(!isset(self::$instance)) {
            self::$instance = new ITemplate();
        }
        return self::$instance;
    }

    /**
     * Loads in all functions in the ITemplate library
     */
    public function loadFunctions(){
        $dir =  self::dirHome().'Functions';
        foreach(glob($dir.'/*.php') as $function) {
            require_once($function);
        }
    }

    private function __construct() {
        $this->loadFunctions();
    }

    function __destruct() {}

}


ITemplate::getInstance();
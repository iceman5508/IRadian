<?php
/**
 * The bootstrap file for loading files
 * This file needs to be included in files that are going to use
 * the framework.
 */

define('BASEPATH', __DIR__);
define('CORE', BASEPATH.'\core');

//include IEngine Library
require_once 'core/IEngine/IEngine.php';

//include ITemplate library
require_once 'core/ITemplate/ITemplate.php';

//include IRadian library
require_once 'core/IRadian/IRadian.php';

//load in API classes
require_once 'core/API/api.php';

//include config file
require_once 'iConfig.php';

//function for loading all library functions
function loadFunctions(){

    foreach(glob(LIBS.'/functions/*.php') as $function)
    {
        if(basename($function) != 'index.php'){
            require_once($function);
        }
    }
}

    /**
     * Auto load classes as needed
     * @param $classname - the class name
     * @throws Exception
     */
    function __autoload($classname){

        $parts = explode('\\', $classname);
        $classname = end($parts);

        if(file_exists(CORE.'/IEngine/Classes/'.basename($classname).'.php')){
            require_once CORE.'/IEngine/Classes/'.basename($classname).'.php';
        }else if(file_exists(CORE.'/IEngine/Classes/iExtensions/'.basename($classname).'.php')){
            require_once CORE.'/IEngine/Classes/iExtensions/'.basename($classname).'.php';
        }else if(file_exists(CORE.'/ITemplate/Classes/'.basename($classname).'.php')){
            require_once CORE.'/ITemplate/Classes/'.basename($classname).'.php';
        }else if(file_exists(CORE.'/ITemplate/Classes/iExtensions/'.basename($classname).'.php')){
            require_once CORE.'/ITemplate/Classes/iExtensions/'.basename($classname).'.php';
        }
        else if(file_exists(CORE.'/IRadian/Classes/'.basename($classname).'.php')){
            require_once CORE.'/IRadian/Classes/'.basename($classname).'.php';
        }else if(file_exists(CORE.'/IRadian/Classes/iExtensions/'.basename($classname).'.php')){
            require_once CORE.'/IRadian/Classes/iExtensions/'.basename($classname).'.php';
        }else if(file_exists( BASEPATH.'/core/API/Classes/'.$classname.'.php')){
            require_once BASEPATH.'/core/API/Classes/'.$classname.'.php';
        }
        else if(file_exists( LIBS.'/classes/'.$classname.'.php')){
            require_once  LIBS.'/classes/'.$classname.'.php';
        }


    }


loadFunctions();




/**********************************Custom bootstraps******************************************/
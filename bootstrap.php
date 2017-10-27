<?php
/**
 * Created by Isaac Parker.
 * User: iceman5508
 * Date: 10/20/2017
 * Time: 1:00 PM
 * The bootstrap file for loading files
 */

define('BASEPATH', __DIR__);
define('CORE', BASEPATH.'\core');

//include IEngine Library
require_once 'core/IEngine/IEngine.php';

//include ITemplate library
require_once 'core/ITemplate/ITemplate.php';

//include IRadian library
require_once 'core/IRadian/IRadian.php';

//include config file
require_once 'iConfig.php';

//function for loading all library functions
function loadFunctions(){

    foreach(glob(LIBS.'/*.php') as $function)
    {
        require_once($function);
    }
}

/**
 * Auto load classes as needed
 * @param $classname - the class name
 * @throws Exception
 */
function __autoload($classname){
    if(file_exists(CORE.'/IEngine/Classes/'.basename($classname).'.php')){
        require_once CORE.'/IEngine/Classes/'.basename($classname).'.php';
    }else if(file_exists(CORE.'/IEngine/Classes/iExtensions/'.basename($classname).'.php')){
        require_once CORE.'/IEngine/Classes/iExtensions/'.basename($classname).'.php';
    }else if(file_exists(CORE.'/ITemplate/Classes/'.basename($classname).'.php')){
        require_once CORE.'/ITemplate/Classes/'.basename($classname).'.php';
    }else if(file_exists(CORE.'/ITemplate/Classes/iExtensions/'.basename($classname).'.php')){
        require_once CORE.'/ITemplate/Classes/iExtensions/'.basename($classname).'.php';
    }

}


loadFunctions();

/**********************************Custom bootstraps******************************************/
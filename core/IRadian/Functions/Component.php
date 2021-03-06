<?php

/**
 * Loads in a component to the file to be used
 * @param  $name - the name of the file without
 * @param bool $relative, if component is being loaded directly from the root file - false
 * true - If component is in relative path to file loading it
 * $relative is true by default
 * @return bool - true if the component was loaded, false if not
 * <br>DO NOT ALTER
 */
function loadComponent( $name,  $relative = true){
    if(!$relative){
        $location = 'app/'.$name.'.php';
        if(file_exists($location)){
            require_once $location;
            return true;
        }
        return false;
    }else{

        if(file_exists($name.'.php')){
            require_once $name.'.php';
            return true;
        }
        return false;
    }
}



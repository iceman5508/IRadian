<?php
/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 10/18/2017
 * Time: 10:18 AM
 * This class holds all component information
 */

namespace ITemplate\iExtends;



final class iComponents
{
    private $__vars = array();


    public function __destruct(){
        unset($this->__vars);
    }

    public function __get($property) {
        if (isset($this->__vars[$property])) {
            return $this->__vars[$property];
        } else {  return null; }
    }

    public function __set($property, $value) {
        $this->__vars[$property] = $value;
    }

    public function getVars(){
        return $this->__vars;
    }

}
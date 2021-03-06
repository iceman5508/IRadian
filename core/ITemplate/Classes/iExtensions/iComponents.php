<?php

namespace ITemplate\iExtends;


/**
@version 1.0 Beta
 * <br>
 *This is the super class for all components.
 * There is not interaction with this class directly.
 */

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
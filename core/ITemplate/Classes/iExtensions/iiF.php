<?php
/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 1/21/2018
 * Time: 11:45 AM
 */

namespace ITemplate\iExtends;


class iiF
{
    private $ifs = array();
    private $conditions = array('==','>','<','>=','<=', '!=');

    function __construct($ifs, $component)
    {

        foreach ($ifs as $if){

            $conditionBreak = explode(' ',get_data_between($if));
            if(count($conditionBreak)>1){
                $condition = $conditionBreak[1];
                if(in_array($condition, $conditionBreak)){
                    if(trim($condition)==='=='){
                       if($this->eq($component, $conditionBreak)){
                          $this->ifs[$if]  = $this->handleIfElse(true,$if);
                       }else{
                           $this->ifs[$if]  = $this->handleIfElse(false,$if);
                       }
                    }else if(trim($condition)==='!='){
                        if($this->neq($component, $conditionBreak)){
                            $this->ifs[$if]  = $this->handleIfElse(true,$if);
                        }else{
                            $this->ifs[$if]  = $this->handleIfElse(false,$if);
                        }
                    }else if(trim($condition)==='>'){
                        if($this->gt($component, $conditionBreak)){
                            $this->ifs[$if]  = $this->handleIfElse(true,$if);
                        }else{
                            $this->ifs[$if]  = $this->handleIfElse(false,$if);
                        }
                    }
                    else  if(trim($condition)==='<'){
                        if($this->lt($component, $conditionBreak)){
                            $this->ifs[$if]  = $this->handleIfElse(true,$if);
                        }else{
                            $this->ifs[$if]  = $this->handleIfElse(false,$if);
                        }
                    }else  if(trim($condition)==='<='){
                        if($this->loe($component, $conditionBreak)){
                            $this->ifs[$if]  = $this->handleIfElse(true,$if);
                        }else{
                            $this->ifs[$if]  = $this->handleIfElse(false,$if);
                        }
                    }
                    else  if(trim($condition)==='>='){
                        if($this->goe($component, $conditionBreak)){
                            $this->ifs[$if]  = $this->handleIfElse(true,$if);
                        }else{
                            $this->ifs[$if]  = $this->handleIfElse(false,$if);
                        }
                    }
                }
            }else if(count($conditionBreak)==1 && strlen(trim($conditionBreak[0]))>0){
                if(isset($component->{$conditionBreak[0]}) && $component->{$conditionBreak[0]} === true){
                    $this->ifs[$if]  = $this->handleIfElse(true,$if);
                }else{
                    $this->ifs[$if]  = $this->handleIfElse(false,$if);
                }

            }

        }

    }

    function __destruct(){
       unset($this->ifs);
       unset($this->conditions);
    }


    /**
     * Handles equal statements
     * @param $component
     * @param $conditionBreak
     * @return bool
     */
    private function eq($component, $conditionBreak){
        if(isset($component->{$conditionBreak[0]})){
            $element1 = $component->{$conditionBreak[0]};
            if(isset($component->{$conditionBreak[2]})){
                $element2 = $component->{$conditionBreak[2]};
                if(trim($element1)===trim($element2)){
                    return true;
                }else
                    if(trim($element1)==trim($element2)){
                        return true;
                    }
            }else if(trim($element1)===trim($conditionBreak[2])){
                return true;
            }else if(trim($element1)==trim($conditionBreak[2])){
                return true;
            }
        }else if(isset($component->{$conditionBreak[2]})){
            if(trim($component->{$conditionBreak[2]})===trim($conditionBreak[0])){
                return true;
            }else if(trim($component->{$conditionBreak[2]})==trim($conditionBreak[0])){
                return true;
            }
        }
        return false;
    }

    /**
     * Handles not equal statements
     * @param $component
     * @param $conditionBreak
     * @return bool
     */
    private function neq($component, $conditionBreak){
        if(isset($component->{$conditionBreak[0]})){
            $element1 = $component->{$conditionBreak[0]};
            if(isset($component->{$conditionBreak[2]})){
                $element2 = $component->{$conditionBreak[2]};
                if(trim($element1)!==trim($element2)){
                    return true;
                }else
                    if(trim($element1)!=trim($element2)){
                        return true;
                    }
            }else if(trim($element1)!==trim($conditionBreak[2])){
                return true;
            }else if(trim($element1)!=trim($conditionBreak[2])){
                return true;
            }
        }else if(isset($component->{$conditionBreak[2]})){
            if(trim($component->{$conditionBreak[2]})!==trim($conditionBreak[0])){
                return true;
            }else if(trim($component->{$conditionBreak[2]})!=trim($conditionBreak[0])){
                return true;
            }
        }
        return false;
    }

    /**
     * Handle greater than statements
     * @param $component
     * @param $conditionBreak
     * @return bool
     */
    private function gt($component, $conditionBreak){
        if(isset($component->{$conditionBreak[0]})){
            $element1 = $component->{$conditionBreak[0]};
            if(isset($component->{$conditionBreak[2]})){
                $element2 = $component->{$conditionBreak[2]};
                  if(count($conditionBreak)==4 && $conditionBreak[3]==='size'){
                      if(is_array($element1) && is_array($element2)){
                          if(count($element1) > count($element2)){
                              return true;
                          }
                      }else if(is_string($element1) && is_string($element2)){
                          if(strlen($element1) > strlen($element2)){
                              return true;
                          }
                      }
                  }else{
                          if($element1 > $element2){
                              return true;
                          }

                  }
            }else{
                $element2 = trim($conditionBreak[2]);
                if(count($conditionBreak)==4 && $conditionBreak[3]==='size'){
                    if(is_array($element1)){
                        if(count($element1) > $element2){
                            return true;
                        }
                    }else if(is_string($element1)){
                        if(strlen($element1) > $element2){
                            return true;
                        }
                    }
                }else{
                    if($element1 > $element2){
                        return true;
                    }

                }
            }
        }else if(isset($component->{$conditionBreak[2]})){
            $element2 = $component->{$conditionBreak[2]};
            $element1 = trim($conditionBreak[0]);
            if(count($conditionBreak)==4 && $conditionBreak[3]==='size'){
                if(is_array($element2)){
                    if($element1 > count($element2)){
                        return true;
                    }
                }else if(is_string($element2)){
                    if($element1 > strlen($element2)){
                        return true;
                    }
                }
            }else{
                if($element1 > $element2){
                    return true;
                }

            }
        }
        return false;
    }

    /**
     * Handle less than statements
     * @param $component
     * @param $conditionBreak
     * @return bool
     */
    private function lt($component, $conditionBreak){
        if(isset($component->{$conditionBreak[0]})){
            $element1 = $component->{$conditionBreak[0]};
            if(isset($component->{$conditionBreak[2]})){
                $element2 = $component->{$conditionBreak[2]};
                if(count($conditionBreak)==4 && $conditionBreak[3]==='size'){
                    if(is_array($element1) && is_array($element2)){
                        if(count($element1) < count($element2)){
                            return true;
                        }
                    }else if(is_string($element1) && is_string($element2)){
                        if(strlen($element1) < strlen($element2)){
                            return true;
                        }
                    }
                }else{
                    if($element1 < $element2){
                        return true;
                    }

                }
            }else{
                $element2 = trim($conditionBreak[2]);
                if(count($conditionBreak)==4 && $conditionBreak[3]==='size'){
                    if(is_array($element1)){
                        if(count($element1) < $element2){
                            return true;
                        }
                    }else if(is_string($element1)){
                        if(strlen($element1) < $element2){
                            return true;
                        }
                    }
                }else{
                    if($element1 < $element2){
                        return true;
                    }

                }
            }
        }else if(isset($component->{$conditionBreak[2]})){
            $element2 = $component->{$conditionBreak[2]};
            $element1 = trim($conditionBreak[0]);
            if(count($conditionBreak)==4 && $conditionBreak[3]==='size'){
                if(is_array($element2)){
                    if($element1 < count($element2)){
                        return true;
                    }
                }else if(is_string($element2)){
                    if($element1 < strlen($element2)){
                        return true;
                    }
                }
            }else{
                if($element1 < $element2){
                    return true;
                }

            }
        }
        return false;
    }

    /**
     * Handle less than or equal to statements
     * @param $component
     * @param $conditionBreak
     * @return bool
     */
    private function loe($component, $conditionBreak){
        if($this->lt($component, $conditionBreak) || $this->eq($component, $conditionBreak)){
            return true;
        }else{return false;}
    }

    /**
     * Handles greater than or equal to statements
     * @param $component
     * @param $conditionBreak
     * @return bool
     */
    private function goe($component, $conditionBreak){
        if($this->gt($component, $conditionBreak) || $this->eq($component, $conditionBreak)){
            return true;
        }else{return false;}
    }


    /**
     * Handle else statements
     * @param $value
     * @param $if
     * @return string
     */
    private function handleIfElse($value,$if){
            $breakElse  = explode('else', $if);
            if($value===true){
                return trim(get_data_between_brace($breakElse[0]));
            }else{
                if(count($breakElse) > 1){
                    return trim(get_data_between_brace($breakElse[1]));
                }

                return '';
            }
    }



    /**
     * @return array
     */
    public function getIfs(){
        return $this->ifs;
    }
}
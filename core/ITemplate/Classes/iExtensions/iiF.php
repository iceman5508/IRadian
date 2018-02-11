<?php


namespace ITemplate\iExtends;

/**
@version 1.0 Beta
 * <br>
 * This class handles if statements in the template.
 * If statements can be ran through the template with the irIf tag or #irIf script.
 *These statements can be ran anywhere within the template, including template based loops.
 *
 * <br>
 * Template based if statements are handled in the
 * same manner as traditional if statements in any programming/scripting language.
 * However, since this is strictly template based if statements.
 * Whatever is in the validating position of the if statement will be returned to the template.
 *<br>
 *The user will not interact with the class directly. Rather it will be called from
 * the template.
 * <br>
 * Example: <irIf>(currentRoute == '/home'){'home'}<irIf>
 * <br>
 * Example: <irIf>(currentRoute == '/home'){'home'}else{'not home'}<irIf>
 * <br>
 * Example: #irIf(currentRoute == '/home'){'home'}#
 * <br>
 * Example: #irIf(currentRoute == '/home'){'home'}else{'not home'} #
 *
 **/
class iiF
{
    /**
     * Array of evaluated ifs
     * @var array
     */
    private $ifs = array();

    /**
     * Array of possible if states
     * @var array
     */
    private $conditions = array('==','>','<','>=','<=', '!=');

    /**
     * Component the if statement will be evaluated on.
     * @var
     */
    private $component;

    /**
     * iiF constructor.
     * @param $ifs
     * @param $component
     */
    function __construct($ifs, $component)
    {
        $this->component = $component;

        foreach ($ifs as $if){

            $conditionBreak = explode(' ',get_data_between($if));
            if(count($conditionBreak)>1){
                $condition = $conditionBreak[1];
                if(in_array($condition, $conditionBreak)){
                    if(trim($condition)==='=='){
                       if($this->eq( $conditionBreak)){
                          $this->ifs[$if]  = $this->handleIfElse(true,$if);
                       }else{
                           $this->ifs[$if]  = $this->handleIfElse(false,$if);
                       }
                    }else if(trim($condition)==='!='){
                        if($this->neq( $conditionBreak)){
                            $this->ifs[$if]  = $this->handleIfElse(true,$if);
                        }else{
                            $this->ifs[$if]  = $this->handleIfElse(false,$if);
                        }
                    }else if(trim($condition)==='>'){
                        if($this->gt( $conditionBreak)){
                            $this->ifs[$if]  = $this->handleIfElse(true,$if);
                        }else{
                            $this->ifs[$if]  = $this->handleIfElse(false,$if);
                        }
                    }
                    else  if(trim($condition)==='<'){
                        if($this->lt( $conditionBreak)){
                            $this->ifs[$if]  = $this->handleIfElse(true,$if);
                        }else{
                            $this->ifs[$if]  = $this->handleIfElse(false,$if);
                        }
                    }else  if(trim($condition)==='<='){
                        if($this->loe( $conditionBreak)){
                            $this->ifs[$if]  = $this->handleIfElse(true,$if);
                        }else{
                            $this->ifs[$if]  = $this->handleIfElse(false,$if);
                        }
                    }
                    else  if(trim($condition)==='>='){
                        if($this->goe($conditionBreak)){
                            $this->ifs[$if]  = $this->handleIfElse(true,$if);
                        }else{
                            $this->ifs[$if]  = $this->handleIfElse(false,$if);
                        }
                    }
                }
            }else if(count($conditionBreak)==1 && strlen(trim($conditionBreak[0]))>0){
                  $strSpl = explode('!',trim($conditionBreak[0]));
                  try {
                      if(count($strSpl)>1){
                          $no = true;
                          $str = $strSpl[1];
                      }else{
                          $no = false;
                          $str = $strSpl[0];
                      }
                      if ($no) {
                            if($this->component->{$str}){
                                $this->ifs[$if] = $this->handleIfElse(false, $if);
                            }else{
                                $this->ifs[$if] = $this->handleIfElse(true, $if);
                            }

                      } else {
                          if($this->component->{$str}){
                              $this->ifs[$if] = $this->handleIfElse(true, $if);
                          }else{
                              $this->ifs[$if] = $this->handleIfElse(false, $if);
                          }
                      }

                  }catch (\Exception $e){

                  }

            }

        }

    }

    function __destruct(){
       unset($this->ifs);
       unset($this->conditions);
       unset($this->component);
    }


    /**
     * Handles equal statements
     * @param $conditionBreak
     * @return bool
     */
    private function eq($conditionBreak){
        if(isset($this->component->{$conditionBreak[0]})){
            $element1 = $this->component->{$conditionBreak[0]};
            if(isset($this->component->{$conditionBreak[2]})){
                $element2 = $this->component->{$conditionBreak[2]};
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
        }else if(isset($this->component->{$conditionBreak[2]})){
            if(trim($this->component->{$conditionBreak[2]})===trim($conditionBreak[0])){
                return true;
            }else if(trim($this->component->{$conditionBreak[2]})==trim($conditionBreak[0])){
                return true;
            }
        }
        return false;
    }

    /**
     * Handles not equal statements
     * @param $conditionBreak
     * @return bool
     */
    private function neq($conditionBreak){
        if(isset($this->component->{$conditionBreak[0]})){
            $element1 = $this->component->{$conditionBreak[0]};
            if(isset($this->component->{$conditionBreak[2]})){
                $element2 = $this->component->{$conditionBreak[2]};
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
        }else if(isset($this->component->{$conditionBreak[2]})){
            if(trim($this->component->{$conditionBreak[2]})!==trim($conditionBreak[0])){
                return true;
            }else if(trim($this->component->{$conditionBreak[2]})!=trim($conditionBreak[0])){
                return true;
            }
        }
        return false;
    }

    /**
     * Handle greater than statements
     * @param $conditionBreak
     * @return bool
     */
    private function gt($conditionBreak){
        if(isset($this->component->{$conditionBreak[0]})){
            $element1 = $this->component->{$conditionBreak[0]};
            if(isset($this->component->{$conditionBreak[2]})){
                $element2 = $this->component->{$conditionBreak[2]};
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
        }else if(isset($this->component->{$conditionBreak[2]})){
            $element2 = $this->component->{$conditionBreak[2]};
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
     * @param $conditionBreak
     * @return bool
     */
    private function lt($conditionBreak){
        if(isset($this->component->{$conditionBreak[0]})){
            $element1 = $this->component->{$conditionBreak[0]};
            if(isset($this->component->{$conditionBreak[2]})){
                $element2 = $this->component->{$conditionBreak[2]};
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
        }else if(isset($this->component->{$conditionBreak[2]})){
            $element2 = $this->component->{$conditionBreak[2]};
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
     * @param $conditionBreak
     * @return bool
     */
    private function loe($conditionBreak){
        if($this->lt($conditionBreak) || $this->eq($conditionBreak)){
            return true;
        }else{return false;}
    }

    /**
     * Handles greater than or equal to statements
     * @param $conditionBreak
     * @return bool
     */
    private function goe($conditionBreak){
        if($this->gt($conditionBreak) || $this->eq($conditionBreak)){
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
        $givenVar = $this->parseStar($if);


       foreach($givenVar as $var){
           $breakObj= explode('->',$var);
           $breakArray = explode('[',$var);

           if(count($breakArray) == 1 && count($breakObj) ==1){
               if(isset($this->component->{$var})){
                   $replacement = $this->component->{$var};
                   $if =  $this->varEval($var, $replacement, $if);
               }
           }
           else if(count($breakArray) > 1){
               if(isset($this->component->{trim($breakArray[0])})){
                   $replacement = $this->component->{trim($breakArray[0])};
                   $if =  $this->varEval($var, $replacement, $if);
               }
               unset($breakArray);
               unset($breakObj);
           }
           else if(count($breakObj) > 1){
               if(isset($this->component->{trim($breakObj[0])})){
                   $replacement = $this->component->{trim($breakObj[0])};
                   $if =  $this->varEval($var, $replacement, $if);
               }
               unset($breakArray);
               unset($breakObj);
           }

        }

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

    /**Parse hash from data
     * @param $content
     * @return mixed
     */
    private function parseStar($content){
        $pattern = "/\*(.*?)\*/";
        preg_match_all($pattern, $content, $matches);
        return $matches[1];
    }

    /**
     * Evaluate the variable
     * @param $replacement
     * @param $string
     * @return mixed
     */
    private function varEval($vars,$replacement, $string){



            if(is_array($replacement)){

                $search = $this->parseSBrace($vars);
                $breakSearch = explode('->',$vars);

                if((isset($search[0]) && strlen($search[0])<1) || count($breakSearch)>0){

                    if(isset($breakSearch[1])){
                        if(isset($replacement[$breakSearch[1]])) {
                            $replacement2 = $replacement[$breakSearch[1]];
                        }
                    }else{

                        if(isset($replacement[$breakSearch[0]])){
                            $replacement2 = $replacement[$breakSearch[0]];
                        }
                    }

                }else{

                    if(isset($replacement[$search[0]])) {
                        $replacement2 = $replacement[$search[0]];
                    }
                }
                $string = str_replace(trim("*$vars*"), $replacement2, $string);
            }else{

                $string = str_replace(trim("*$vars*"), $replacement, $string);
            }

        return $string;
    }

    /**
     * Parse the data between a square brace
     * @param $data
     * @return mixed
     */
    private function parseSBrace($data){
        $pattern = "/\[(.*?)\]/";
        preg_match_all($pattern, $data, $matches);
        return $matches[1];
    }
}
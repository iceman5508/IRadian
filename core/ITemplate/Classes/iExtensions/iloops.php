<?php
/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 1/19/2018
 * Time: 1:06 PM
 */

namespace ITemplate\iExtends;


class iloops
{

    private $loops = array();

    function __construct($loops, $component)
    {
        foreach ($loops as $loop){

            $conditionBreak = explode(' ',get_data_between($loop));

            $type = $conditionBreak[1];

            if(trim($type)==='in'){
                $this->loops[$loop] = $this->foreachLoop($component, $conditionBreak, $loop);
            }elseif(trim($type)==='of'){
                $this->loops[$loop] = $this->forLoop($component, $conditionBreak, $loop);

            }
        }

    }

    function __destruct()
    {
        unset($this->loops);
    }

    /**
     * @return mixed
     */
    public function getLoops()
    {
        return $this->loops;
    }


    /**
     * Handle foreach loops
     * @param $component
     * @param $conditionBreak
     * @param $loop
     * @return string
     */
    private function foreachLoop($component, $conditionBreak, $loop){
        $var = $component->{$conditionBreak[2]};
        $as = $conditionBreak[0];
        $loopInner = get_data_between_brace($loop);
        $loopstr = '';
        foreach( $var as ${$as}){
            $loopstr .=  $this->varEval(${$as}, $loopInner);
        };
        return $loopstr;

    }

    /**
     * Handles for loops
     * @param $component
     * @param $conditionBreak
     * @param $loop
     * @return string
     */
    private function forLoop($component, $conditionBreak, $loop){
        $var = $component->{$conditionBreak[2]};
        $as = $conditionBreak[0];
        $increment =  $conditionBreak[3];
        $loopInner = get_data_between_brace($loop);
        $loopstr = '';
        for( ${$as} =0; ${$as} <count($var); ${$as} = ${$as}+$increment){
            $loopstr .= $this->varEval($var[${$as}], $loopInner);
        };

        return $loopstr;

    }

    /**
     * Evaluate the variable
     * @param $replacement
     * @param $string
     * @return mixed
     */
    private function varEval($replacement, $string){

        $vars = $this->parseHash($string);

        for($i=0; $i<count($vars); $i++){

            if(is_array($replacement)){
                $breakSearch = explode('->',$vars[$i]);
                if(isset($breakSearch[1])){
                    $replacement2 = $replacement[$breakSearch[1]];
                }else{
                    $replacement2 = $replacement[$breakSearch[0]];
                }

                $string = str_replace(trim("#$vars[$i]#"), $replacement2, $string);
            }else{

                $string = str_replace(trim("#$vars[$i]#"), $replacement, $string);
            }
        }
        return $string;
    }

    /**Parse hash from data
     * @param $content
     * @return mixed
     */
    private function parseHash($content){
        $pattern = "/#(.*?)#/s";
        preg_match_all($pattern, $content, $matches);
        return $matches[1];
    }

}
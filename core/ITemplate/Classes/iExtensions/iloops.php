<?php

namespace ITemplate\iExtends;

/**
@version 1.0 Beta
 * <br>
 *This class handles all template loops.
 * <br>
 * Possible looping types are for loops and foreach loop. However, while structurally
 * template loops may look the same as traditional loops; there are differences that matter.
 * Main, the keywords "of" and "in". <br>
 *
 * In a traditional foreach loop<br>
 * foreach(items as item)
 * <br>
 * In a template foreach loop<br>
 * (item in items)
 * <br>
 *  In a traditional for loop<br>
 * for(i=0; i<sizeof(items) i++)
 *<br>
 * In a template for loop<br>
 * (i of items 1)
 *
 **/

class iloops
{

    /**
     * Holds all evaluated loop data
     * @var array
     */
    private $loops = array();

    /**
     * iloops constructor.
     * @param $loops
     * @param $component
     */
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
     * Return all evaluated loop data
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
        $loopInner = get_data_between_braceLoop($loop);
        $loopstr = '';
        foreach( $var as ${$as}){
           $loopstr .=  $this->varEval(${$as}, $loopInner);
        };
       return  $this->parseIfs($loopstr, $component);

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
        $loop = $this->parseIfs($loop, $component);
        $loopInner = get_data_between_braceLoop($loop);
        $loopstr = '';
        for( ${$as} =0; ${$as} <count($var); ${$as} = ${$as}+$increment){
            $loopstr .= $this->varEval($var[${$as}], $loopInner);
        };

        return  $this->parseIfs($loopstr, $component);

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

                $search = $this->parseSBrace($vars[$i]);
                $breakSearch = explode('->',$vars[$i]);

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
        $pattern = "/#(.*?)#/";
        preg_match_all($pattern, $content, $matches);
        return $matches[1];
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

    /**
     * Parse the if associated with the irIf tag
     */
    private function parseIfs($content, $component){
        $pattern = "/#irIf(.*?)#/s";
        preg_match_all($pattern, $content, $matches);

        $pattern = "/<irIf>(.*?)<\/irIf>/s";
        preg_match_all($pattern, $content, $matches2);


        $matches = array_merge($matches[1], $matches2[1]);
        $ifs = new iiF($matches, $component);


        foreach ($ifs->getIfs() as $if => $value){
            if (strpos($content, $if) !== false) {
                $content = str_replace(trim("#irIf" . $if . "#"), $value, trim($content));
                $content = str_replace(trim("<irIf>" . $if . "</irIf>"), $value, trim($content));
            }
        }
        return $content;
    }



}
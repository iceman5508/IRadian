<?php
/**
 * Functions related extracting data from the template.
 * IMPORTANT DO NOT ALTER ANYTHING IN THIS FILE!!!!!
 */

/**credit Thorlax402
 * used to get data between () in the template
 */
if(!function_exists("get_data_between")){
    function get_data_between($content){
        $start = "(";
        $end = ")";
        $i = strpos($content, $start);
        if($i === false){
            return "";
        }else{
            $i+=strlen($start);
            $len = strpos($content, $end, $i)-$i;
            return substr($content, $i, $len);
        }
    }
}

if(!function_exists("get_data_between_brace")){
    function get_data_between_brace($content){
        $start = "{";
        $end = "}";
        $i = strpos($content, $start);
        if($i === false){
            return "";
        }else{
            $i+=strlen($start);
            $len = strpos($content, $end, $i)-$i;
            return substr($content, $i, $len);
        }
    }
}

if(!function_exists("get_data_between_braceLoop")){
    function get_data_between_braceLoop($content){
        $start = "{{";
        $end = "}}";
        $i = strpos($content, $start);
        if($i === false){
            return "";
        }else{
            $i+=strlen($start);
            $len = strpos($content, $end, $i)-$i;
            return substr($content, $i, $len);
        }
    }
    }
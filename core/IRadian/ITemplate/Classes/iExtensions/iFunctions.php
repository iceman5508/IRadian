<?php
/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 1/2/2018
 * Time: 8:03 AM
 */

namespace ITemplate\iExtends;


class iFunctions
{
    private $functions = array();

    function __construct($functions, $component)
    {
        foreach ($functions as $func){

            $funName = substr($func,0,strpos($func, '('));
            if(!empty($funName)){
                if(function_exists($funName)){
                    $this->functions[$func]= eval("return ".$func.";");
                }else if(method_exists($component, $funName)){

                    $params = get_data_between($func);
                    if(empty($params)){
                        $this->functions[$func] = $component->{$funName}();
                    }else{
                        $data =  call_user_func_array(array($component,$funName), explode(",",$params));
                        $this->functions[$func] = $data;
                    }
                }
            }else{
                $this->functions[$func]= eval("return ".$func.";");
            }

        }

    }

    function __destruct()
    {
        unset($this->functions);
    }

    /**
     * @return mixed
     */
    public function getFunctions()
    {
        return $this->functions;
    }

}
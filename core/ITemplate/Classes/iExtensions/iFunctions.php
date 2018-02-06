<?php



namespace ITemplate\iExtends;

/**
@version 1.0 Beta
 * <br>
 *This class handles reading and running functions from the template.
 * There is no direct interaction between the user and this class.
 * It is called automatically based on the use of the function tag in the template.
 * <br>
 *The functions that can be used in a particular component
 * are restricted to all native php functions, functions from
 * the separate core libraries, functions in the libs folder
 * and functions local only to the particular component
 *
 * <br>
 * Function tag:  <irFun> 1+1 </irFun>
 *<br>
 * Function tag:  <irFun> date('m/d/Y h:i:s a', time()) </irFun>
 * <br>
 * Function tag:  <irFun> componentFunction(param,param,param) </irFun>
 */
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
     * Return a list of evaluated functions
     * @return mixed
     */
    public function getFunctions()
    {
        return $this->functions;
    }

}
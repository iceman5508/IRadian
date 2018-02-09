<?php

/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 2/8/2018
 * Time: 2:54 PM
 */
class current extends \ITemplate\iExtends\iComponent
{

    public  function attributes(){
            $this->selected();


    }

    private function selected(){
        if(isset($_GET['selected'])){
            $this->selected = true;
        }

    }

}
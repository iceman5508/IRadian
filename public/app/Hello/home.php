<?php

/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 2/12/2018
 * Time: 11:36 AM
 */
class home extends \ITemplate\iExtends\iComponent
{
    public  function attributes(){
        $this->helloWorld = 'Welcome to '.iConfig::$project['title'];
        $this->image = 'public/assets/logo3.png';


    }
}
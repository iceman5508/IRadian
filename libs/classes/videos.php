<?php

/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 2/11/2018
 * Time: 10:33 AM
 */
class videos extends \IRadian\ibase\iTables
{

    public  function up(){
       $this->varchar('name');
       $this->varchar('comment');
    }

    public  function down(){

    }

}
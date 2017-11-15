<?php

/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 11/15/2017
 * Time: 2:57 PM
 */
class header extends \ITemplate\iExtends\iComponent
{
    public  function render()
    {

    }

    public  function attributes()
    {
        // TODO: Implement attributes() method.
    }

}

$header = new header('layout/header/header.html');
\ITemplate\iExtends\iTags::setTag('header',$header);
\ITemplate\iExtends\iComponent::export('header');


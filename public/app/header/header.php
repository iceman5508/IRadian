<?php
/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 10/17/2017
 * Time: 11:24 PM
 */
use ITemplate\iExtends\iComponent;
use ITemplate\iExtends\iTags;

class header extends iComponent {
    public function render()
    {
        // TODO: Implement render() method.
    }

    public  function attributes()
    {
        // TODO: Implement attributes() method.
    }
}

$header = new header('header/header.html');
$header->menu = 'Welcome To IRadian';
$header->title = iConfig::$project['title'];



iTags::setTag('header',$header);
iComponent::export('header');


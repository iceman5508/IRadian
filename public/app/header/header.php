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
}

$header = new header('header/header.html');
$header->menu = 'Welcome To IRadian';
$header->title = iConfig::$name;


iTags::setTag('header',$header);
iComponent::export('header');

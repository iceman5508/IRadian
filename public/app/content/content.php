<?php
/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 10/17/2017
 * Time: 11:24 PM
 */
use ITemplate\iExtends\iComponent;
use ITemplate\iExtends\iTags;

class middle extends iComponent {
    public function render()
    {
        // TODO: Implement render() method.
    }
}

$middle = new middle('content/content.html');
$middle->section = "IRadian shop";
iTags::setTag('middle',$middle);
iComponent::export('middle');


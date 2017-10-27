<?php
/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 10/17/2017
 * Time: 11:24 PM
 */
use ITemplate\iExtends\iComponent;
use ITemplate\iExtends\iTags;

class about extends iComponent {
    public function render()
    {
        // TODO: Implement render() method.
    }
}

$middle = new about('about/about.html');
$middle->section = "About Page";
$middle->about = "
    IRadian is a framework built purely in php, to closely model a blend of angular2 and laravel. 
    The purpose of this framework is to allow for the smooth and easy creation of web applications
    in a simple and familiar way.
";
iTags::setTag('middle',$middle);
iComponent::export('middle');


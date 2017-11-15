<?php

/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 11/15/2017
 * Time: 3:27 PM
 */
class content extends \ITemplate\iExtends\iComponent
{

    public  function attributes()
    {
        // TODO: Implement attributes() method.
    }

    public  function render()
    {
        // TODO: Implement render() method.
    }
}


$content = new content('layout/content/content.html');
\ITemplate\iExtends\iTags::setTag('content',$content);
\ITemplate\iExtends\iComponent::export('content');
<?php
/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 10/18/2017
 * Time: 10:12 AM
 */

namespace ITemplate\iExtends;
use ITemplate\ibase\iTemplates;

class iView extends iTemplates
{

    /**
     * iView setTag.
     * @param $tag - The tag to process and view
     */
    function setTag($tag)
    {
        $this->setContent(iTags::get($tag));

    }

    /**
     * Return the content of the template that is loaded
     * @return mixed
     */
    public function getContent(){
        return $this->template;
    }

    /**
     * Return the content of the template that is loaded
     * @return mixed
     */
    public function setContent($content){
         $this->template = $content;
    }




}
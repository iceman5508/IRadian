<?php

namespace ITemplate\iExtends;
use ITemplate\ibase\iTemplates;

/**
@version 1.0 Beta
 * <br>
 *This class handles loading views into the application.
 * The user will not interact with this class directly unless they want to
 * manually handle their own view displays.
 *
 **/
class iView extends iTemplates
{

    /**
     * Sets the tag that will be associated with a specific view.
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
     * @param $content - The content to override with
     */
    public function setContent($content){
         $this->template = $content;
    }




}
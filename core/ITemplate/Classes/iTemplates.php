<?php
/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 10/17/2017
 * Time: 11:44 PM
 */

namespace ITemplate\ibase;


class iTemplates
{
    protected $template;

    /**
     * Get the current template file
     * @param $file - the name of the file to grab
     */
    final public function getFile($file) {
        $this->template = file_get_contents('app/'.$file);
    }

    /**
     * Set a particular tag to a value
     * @param $tag - The tag name
     * @param $content - the content to filter through
     */
    final public function set($tag, $content) {
        $this->template = str_replace("{".$tag."}", $content, $this->template);
    }

    /**
     * Render the template
     */
    final public function render() {
        eval("?>".$this->template);
    }

}

?>
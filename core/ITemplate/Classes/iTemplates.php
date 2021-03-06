<?php

namespace ITemplate\ibase;

/**
@version 1.0 Beta
 * <br>
 * This class manages the loading of template files for the view.
 * This is ultimately the root class for all components as they use this
 * class for loading, and rendering templates.
 */

class iTemplates
{
    /**
     * The template to parse.
     * @var
     */
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
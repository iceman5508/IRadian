<?php

namespace ITemplate\iExtends;

/**
@version 1.0 Beta
 * <br>
 *Handles the tag sub-language. Tags is how component variables are passed between the component
 * and the template. This is similar to data binding imn angular.<br>
 * Users will not interact with this class at all, but it runs in the background.
 **/
final class iTags
{
    /**
     * List of all tags.
     * @var array
     */
    private static $tags = array();

    /**
     * Add a specific tag to the tag pool
     * @param $tag - the tag to use
     * @param \ITemplate\iExtends\iComponent $component - The component the tag beelongs to.
     */
    public static function setTag($tag, iComponent &$component)
    {
        $content = file_get_contents($component->getPage());
        foreach ($component->getAllVars() as $var => $value){
            if (strpos($content, $var) !== false) {
                if(!is_array($value)){
                     $content = str_replace("{" . $var . "}", $value, $content);
                }
            }
        }
        $parser = new iParser($content, $component);

        self::$tags[$tag] = $parser->getContent();
    }

    /**
     * Get the value from a specific global
     * @param $tagName - the name of the tag to return
     * @return the value associated with the tag name
     */
    public static function get($tagName)
    {
        if(self::$tags == null) {
            return null;
        }else {
            return self::$tags[$tagName];
        }
    }

    /**
     * Remove a specific tag from the list
     * @param $tagName - The name of the tag to remove
     */
    public static function remove($tagName)
    {
        if(self::$tags !== null) {
            unset(self::$tag[$tagName]);
        }
    }


}
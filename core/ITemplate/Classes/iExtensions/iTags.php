<?php
/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 10/18/2017
 * Time: 2:10 PM
 */

namespace ITemplate\iExtends;


final class iTags
{
    private static $tags = array();

    /**
     * Add a specific tag to the tag pool
     * @param $tag - the tag to use
     * @param \ITemplate\iExtends\iComponent $component
     */
    public static function setTag($tag, iComponent &$component)
    {
        $content = file_get_contents($component->getPage());
        foreach ($component->getAllVars() as $var => $value){
            if (strpos($content, $var) !== false) {
                $content = str_replace("{" . $var . "}", $value, $content);
            }
        }
        self::$tags[$tag] = $content;
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
<?php
/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 10/18/2017
 * Time: 9:05 PM
 */

namespace ITemplate\iExtends;
use ITemplate\iExtends\iView;
use ITemplate\iExtends\iComponent;
use ITemplate\iExtends\iRouter;


abstract class viewManager
{

    private $content;
    private $view;

    /**
     * Create the view manager for all exported components.
     * Should only be ran after all components are registered
     * viewManager constructor.
     * @param $mainFile
     */
    function __construct($mainFile)
    {
        $this->content = file_get_contents('app/'.$mainFile);
        foreach (iComponent::getExports() as $tags => $value){
            if (strpos($this->content, $tags) !== false) {
                $this->content = str_replace("{#" . $tags . "}", $value, $this->content);
            }
        }
        $this->view = new iView();
        $this->view->setContent($this->content);
    }

    /**
     * Render all components
     */
    function render(){
        $this->view->render();
    }

    /**
     * Register a component
     * @param $location - The location of the component php files.
     */
    public static function registerComponent($location){
        if(file_exists('app/'.$location))
        {
            require_once 'app/'.$location;
        }

    }

    /**
     * Connect view Manager to router
     */
    public static function router(){
        if(iRouter::callMade()) {
            viewManager::registerComponent(iRouter::$route);
        }
    }



    function __destruct()
    {
       unset($this->content);
        unset($this->view);
    }


}
<?php

namespace ITemplate\iExtends;


/**
@version 1.0 Beta
 * <br>
 *This class handles the loading of multiple views into the main template.
 * <br>
 * This class is loaded automatically and user will not have to interact with it
 * unless they want to manage their views manually.
 *
 **/
 class viewManager
{
     /**
      * The content of the template
      * @var mixed
      */
    private $content;

     /**
      * The view to display
      * @var \ITemplate\iExtends\iView
      */
    private $view;

    /**
     * Create the view manager for all exported components.
     * Should only be ran after all components are registered
     * viewManager constructor.
     * @param $mainFile - The template file
     * @param $setContent - set if the content of the main file is overridden or not.
     *
     */
    function __construct($mainFile, $setContent = false)
    {
        if(!$setContent){
            $this->content = file_get_contents('app/'.$mainFile);
        }else{
            $this->content = $mainFile;
        }

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
     * <br>However, since version 1.0 Beta this method is no longer heavily used and is slowly being deprecated.
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
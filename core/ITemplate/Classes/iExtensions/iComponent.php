<?php
namespace ITemplate\iExtends;

/**
@version 1.0 Beta
 * <br>
 *This class is to be extended. It is from this class that components are made.
 * <br>
 * From the extensions you can then define component specific variables and functions.
 * <br>
 * Components can be equated to controllers in a traditional MVC.
 */
abstract class iComponent
{
    /**
     * This variable holds the component data
     * @var iComponents
     */
    private $component;

    /**
     * This variable holds the template location
     * @var string
     */
    private $page;

    /**
     * This variable holds the current route associated with the component.
     * <br> How ever, it this variable is set by the framework based on
     * routing data provided.
     * @var string
     */
    public $currentRoute;

    /**
     * This variable is used to expose the component to other aspects of the
     * application. Do not users will have no interaction with this variable directly.
     * @var array
     */
    private static $exports = array();



    /**
     * @return mixed
     * Can set all class var through this method.
     */
    public abstract function attributes();

    /**
     * Component class entry point
     * iComponent constructor.
     * @param $page - The template page the component is for
     * @param $route - The route associated with the component. Not required
     */
    public function __construct($page, $route='/'){
        $this->component = new iComponents();
        $this->page = 'app/'.$page;
        $this->currentRoute=$route;

        $this->attributes();
    }
    /**
     * Return all variables
     * @return array
     */
    public final function getAllVars(){
        return $this->component->getVars();
    }
    /**
     * Export a component to make it loadable in the viewManager
     * @param $componentName
     */
    public static function export($componentName){
        self::$exports[$componentName] = iTags::get($componentName);
    }
    /**
     * Return the name of the page
     * @return mixed
     */
    public final function getPage(){
        return $this->page;
    }


    /**
     * Return all exported components
     * @return array
     */
    public static function getExports(){
        return self::$exports;
    }
    /**Get a specific exported component
     * @param $componentName
     * @return mixed
     */
    public static function getExport($componentName){
        return self::$exports[$componentName];
    }


    public function __destruct(){
        $this->component->__destruct();
        unset($this->component);
        unset($this->page);
        unset($this->currentRoute);
    }
    public final function __set($name, $value){
        $this->component->__set($name,$value);
    }

    public final function __get($name){
        return $this->component->__get($name);
    }
    public final function getView(){
        return $this->view;
    }
}

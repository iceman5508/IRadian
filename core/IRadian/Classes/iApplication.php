<?php


namespace IRadian\ibase;


use IEngine\ibase\iWeb;
use ITemplate\iExtends\iComponent;
use ITemplate\iExtends\iTags;
use ITemplate\iExtends\viewManager;
use IEngine\ibase\iGlobal;

/**
 * @version 1.0<br>
 * Class iApplication - This class is the engine of the entire framework. <br> naturally users will NEVER
 * interact with this class directly. Only interaction users will have with this class is through the iapp file.
 * However, even then the possible actions are very limited and on rails.
 * @package IRadian\ibase
 */
abstract class iApplication
{
    /**
     * List of all components the framework is using
     * @var array
     */
    protected $components=array();

    /**
     * The location of the main view file
     * @var
     */
    protected $html;

    /**
     * The router that will be used.
     * @var iAppRoute
     */
    protected $router;

    /**
     * Holds global variables to use across all application pages
     */
    protected $globals;

    private $viewManager, $parser, $content;

    private $jquery = [
        'js' => PROJECT.'/vendors/jquery/jquery.js'
        ,'ui' =>   PROJECT.'/vendors/jquery/jquery-ui.min.js'
        ,'css' =>   PROJECT.'/vendors/jquery/jquery-ui.min.css'
    ];

    private $bootstrap = [
        'js' =>  PROJECT.'/vendors/bootstrap/bootstrap.bundle.min.js'
        ,'css' =>  PROJECT.'/vendors/bootstrap/bootstrap.css'

    ];


    private $imoduels=[
        'iModal' => [
            'js' => PROJECT.'/core/iModuels/imodal/iModal.js'
            ,'css' => PROJECT.'/core/iModuels/imodal/iModal.css'
            ]
    ];

    function __destruct()
    {
        unset($this->components);
        unset($this->imoduels);
        unset($this->jquery);
        unset($this->bootstrap);
        unset($this->html);
        unset($this->viewManager);
        unset($this->parser);
        unset($this->content);
        unset($this->router);
    }

    /**
     * iApplication constructor. The entry point of the application.
     * <br>The constructor is given all parsed tokenized,
     * components, views and routing information. Then the class decides what to do with them.
     */
    final function __construct(){
        try {
            if (\iConfig::$security['route_limit'] !== NULL && is_numeric(\iConfig::$security['route_limit'])) {
                if (iAppSecurity::routeLimit(\iConfig::$security['route_limit'])) {
                    iredirect_to(iWeb::projectUrl());
                    exit();
                }
            }

            $this->router = new iAppRoute(\iConfig::$project['route_var']);
            $this->initialSteps();
            $this->finalSteps();
        }catch (\Exception $e){
            print "error";
            die();
        }


    }

    /**
     * Handles load from ui.
     * @param $ui
     */
    private function handleUI($ui){
    foreach ($ui as $u){
        $uiName = "#ui[$u]";
        $breakUI = explode(',',$u);
        $value='';
        foreach ($breakUI as $break){

            if(trim($break) === trim('jquery_css')){
                $value .= '<link href="'.$this->jquery['css'].'" rel="stylesheet" type="text/css" media="all">';
            }else if(trim($break) === trim(' bootstrap_css')){
                $value .='<link href="'.$this->bootstrap['css'].'" rel="stylesheet" type="text/css" media="all">';
            }else if(trim($break) === trim(' imodal_css')){
                $value .='<link href="'.$this->imoduels['iModal']['css'].'" rel="stylesheet" type="text/css" media="all">';
            }elseif(trim($break) === trim('jquery_js')){
                $value .= '<script type="text/javascript" src="'.$this->jquery['js'].'"></script>';
            }else if(trim($break) === trim(' jquery_ui')){
                $value .= '<script type="text/javascript" src="'.$this->jquery['ui'].'"></script>';
            }else if(trim($break) === trim(' bootstrap_js')){
                $value .= '<script type="text/javascript" src="'.$this->bootstrap['js'].'"></script>';
            }
            else if(trim($break) === trim('imodal_js')){
                $value .= '<script type="text/javascript" src="'.$this->imoduels['iModal']['js'].'"></script>';
            }

        }
            $this->content = $this->replaceAllInstance($this->content,$uiName,$value);
        }
    }

    /**
     * Handles load from moduel
     * @param $moduel
     */
    private function handleModuel($moduel){
    foreach ($moduel as $m){
        $modName = "#module[$m]";
        $breakModuel = explode(',',$m);
        $value='';
        foreach ($breakModuel as $break){
            $location = PROJECT.'/core/iModuels/'.trim($break).'.js';

            $content = file_get_contents($location);
            if(strlen($content) > 1){
                $value .= '<script type="text/javascript" src="' . $location . '"></script>';
            }
        }
        $this->content = $this->replaceAllInstance($this->content,$modName,$value);
        unset($content);
    }
}

    /**
     * @param $config
     * handle loads from config
     */
    private function handleConfig($config){
        $replacements = array();
        foreach ($config as $c){
            $conName = "#config[$c]";
                $value='';
                if(isset(\iConfig::$project[trim($c)])) {
                    $value .= \iConfig::$project[trim($c)];

                }
            if(!in_array($value, $replacements)) {
                $this->content = $this->replaceAllInstance($this->content, $conName, $value);
                $replacements[] = $value;
            }

        }

    }



    /**
     * @param $heystack
     * @param $neddle
     * @param $replacement
     * @return mixed
     */
    private function replaceAllInstance($heystack, $neddle, $replacement){
        if (strpos($heystack, $neddle) !== false) {
            $content = str_replace("$neddle", $replacement, $heystack);
            return $content;
        }
    }


    /**
     * Handles Complex component loading
     * @param $component
     */
    private function handleComponent($component){
        $key = key($this->components);
        if(array_key_exists ('onCondition' , $component )){
            $condition = $component['onCondition'];
            if($condition[0]===$condition[1]){

                if(array_key_exists ('component' , $component )
                    && array_key_exists ('location' , $component )
                    && array_key_exists ('template' , $component )){

                    if(array_key_exists ('route' , $component )) {
                       if(in_array($this->router->getRoute(),$component['route'])){
                            loadComponent($component['location'],false);
                           $class = new $component['component']($component['template'], $this->router->getRoute());
                           if(array_key_exists ('tag' , $component )){
                                $key = $component['tag'];
                           }
                           iTags::setTag($key, $class);
                           iComponent::export($key);
                        }

                    }else{
                        loadComponent($component['location'],false);
                        $class = new $component['component']($component['template'],$this->router->getRoute());
                        if(array_key_exists ('tag' , $component )){
                            $key = $component['tag'];
                        }
                        iTags::setTag($key, $class);
                        iComponent::export($key);
                    }

                }
            }
        }else{
            if(array_key_exists ('component' , $component )
                && array_key_exists ('location' , $component )
                && array_key_exists ('template' , $component )){
                if(array_key_exists ('route' , $component )) {
                    if(in_array($this->router->getRoute(),$component['route'])){
                        loadComponent($component['location'],false);
                        $class = new $component['component']($component['template'],$this->router->getRoute());
                        if(array_key_exists ('tag' , $component )){
                            $key = $component['tag'];
                        }
                        iTags::setTag($key, $class);
                        iComponent::export($key);
                    }

                }else{
                    loadComponent($component['location'],false);
                    $class = new $component['component']($component['template'],$this->router->getRoute());
                    if(array_key_exists ('tag' , $component )){
                        $key = $component['tag'];
                    }
                    iTags::setTag($key, $class);
                    iComponent::export($key);
                }



            }

        }

    }


    private function initialSteps(){
        $this->router();
        $this->router->scanner();
        $this->handleGlobals();
        $this->main();
        foreach ($this->components as $component){
            if(is_array($component)){
                $this->handleComponent($component);

            }else{
                loadComponent($component, false);
            }
            next($this->components);

        }
    }

    private function finalSteps(){
        $this->content = file_get_contents('app/'.$this->html.'.html');
        $this->parser = new iRParser($this->content);
        $parsed = $this->parser->getParsed();
        $this->handleUI($parsed['ui']);
        $this->handleModuel($parsed['module']);
        $this->handleConfig($parsed['config']);
        $this->viewManager =  new viewManager($this->content,true);
        $this->viewManager->render();
        $this->__destruct();
    }


    private function handleGlobals(){
        $this->globals();
       foreach ($this->globals as $global => $value) {
           iGlobal::add($global, $value);
       }
       unset($this->globals);
        iGlobal::add('router', $this->router);
    }

    /**
     * The main function in which all application data is set.
     */
    protected abstract function main();

    /**
     * The function in which route data is set
     */
    protected abstract function router();

    /**
     * The function in which globals are set
     */
    protected abstract function globals();







}
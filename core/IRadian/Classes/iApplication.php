<?php
/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 1/13/2018
 * Time: 12:36 PM
 * Application class, acts as a manager for the entire application
 * One of the many brains powering the iRadian framework
 */

namespace IRadian\ibase;


use ITemplate\iExtends\iComponent;
use ITemplate\iExtends\iTags;
use ITemplate\iExtends\viewManager;

abstract class iApplication
{
    protected $components=array(), $html;

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
        'iHttpService' => PROJECT.'/core/iModuels/iHttpService.js'
        ,'iEnvironment' => PROJECT.'/core/iModuels/iEnvironments.js'
        ,'iModal' => [
            'js' => PROJECT.'/core/iModuels/iModal.js'
            ,'css' => PROJECT.'/core/iModuels/iModal.css'
            ]
        ,'iVariable' => PROJECT.'/core/iModuels/iVariable.js'

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
    }

    final function __construct()
    {
        $this->main();
        foreach ($this->components as $component){
            if(is_array($component)){
                $this->handleComponent($component);
            }else{
                loadComponent($component, false);
            }
            next($this->components);

        }

        $this->content = file_get_contents('app/'.$this->html.'.html');
        $this->parser = new iRParser($this->content);
        $parsed = $this->parser->getParsed();
        $this->handleUI($parsed['ui']);
        $this->handleModuel($parsed['moduel']);
        $this->handleConfig($parsed['config']);
        $this->viewManager =  new viewManager($this->content,true);
        $this->viewManager->render();
        $this->__destruct();
    }

    /**
     * Handles load from ui
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
            else if(trim($break) === trim(' imodal_js')){
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
        $modName = "#moduel[$m]";
        $breakModuel = explode(',',$m);
        $value='';
        foreach ($breakModuel as $break){
            if(isset($this->imoduels[trim($break)])) {
                $value .= '<script type="text/javascript" src="' . $this->imoduels[trim($break)] . '"></script>';
            }
        }
        $this->content = $this->replaceAllInstance($this->content,$modName,$value);
    }
}

    /**
     * @param $config
     * handle loads from config
     */
    private function handleConfig($config){
        foreach ($config as $c){
            $conName = "#config[$c]";
            $breakConfig = explode(',',$c);
            $value='';
            foreach ($breakConfig as $break){
                if(isset(\iConfig::$project[trim($break)])) {
                    $value .= \iConfig::$project[trim($break)];
                }
            }
            $this->content = $this->replaceAllInstance($this->content,$conName,$value);
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

                    loadComponent($component['location'],false);
                    $class = new $component['component']($component['template']);
                    iTags::setTag($key, $class);
                    iComponent::export($key);

                }
            }
        }else{
            if(array_key_exists ('component' , $component )
                && array_key_exists ('location' , $component )
                && array_key_exists ('template' , $component )){

                loadComponent($component['location'],false);
                $class = new $component['component']($component['template']);
                iTags::setTag($key, $class);
                iComponent::export($key);


            }

        }

    }


    protected abstract function main();







}
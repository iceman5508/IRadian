<?php
require_once '../bootstrap.php';
/**
 * The entry point for the application.
 * Where components and the html page can be set.
 */
    class iApp extends \IRadian\ibase\iApplication
    {
        /**
         * In this function you can set the components to load
         * as well as any other application params.
         * <br>
         * html: The main template page for the application.
         * <br>
         * components:  An array of all components for the application to use
         */
        public function main()
        {
            $strapView = false;
            if($strapView){
                $this->html = 'index';
            }else{
                $this->html = 'index2';
            }

            $this->components = [
                'header' => [
                    'component' => 'header'
                    ,'location' =>  'layout/header/header'
                    ,'template' => 'layout/header/header.html'
                    ,'onCondition' => [$strapView , true ]
                ]

                ,
                'content' =>[
                   'component' =>'content'
                    ,'location' => 'layout/content/content'
                    ,'template' =>'layout/content/content.html'
                    ,'onCondition' => [$strapView , true ]
                    ,'route' => ['/','/home','/404']
                ]
                ,  'welcome' =>[
                    'component' =>'welcomeComponent'
                    ,'location' => 'welcome/welcomeComponent'
                    ,'template' =>'welcome/welcome.html'
                    ,'onCondition' => [$strapView , false ]

                ]
            ];


        }

        /**
         * Holds all the registered routes
         * that the application is allowed to use.
         * <br>
         * Example:  $this->router->register('/routename');
         */
        public function router(){
            $this->router->register('/');
            $this->router->register('/home');

        }


    }








$Application = new iApp();
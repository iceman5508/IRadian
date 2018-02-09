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


            if($this->router->getRoute() == '/home' || $this->router->getRoute() == '/') {
                $this->html = 'home';


            }else{

                if($this->router->getRoute() == '/demo' ) {
                    $this->html = 'demo/index';
                }else{  $this->html = 'demo'; }

                $this->components = [
                    'start' => [
                        'tag' => 'content'
                        ,'component' => 'quickstart'
                        ,'location' => 'quick/quickstart'
                        ,'template' => 'quick/index.html'
                        ,'route' => ['/quick']
                    ]
                    ,
                    '404' => [
                        'tag' => 'content'
                        ,'component' => 'found'
                        ,'location' => '404/found'
                        ,'template' => '404/index.html'
                        ,'route' => ['/404']
                    ]
                    ,'demo' =>[
                        'tag' => 'header'
                        ,'component' => 'header'
                        ,'location' => 'demo/header/header'
                        ,'template' => 'demo/header/header.html'
                        ,'route' => ['/demo']
                    ]
                    , 'playing' =>[
                        'tag' => 'playing'
                        ,'component' => 'current'
                        ,'location' => 'demo/current/current'
                        ,'template' => 'demo/current/current.html'
                        ,'route' => ['/demo']
                    ]
                    , 'all' =>[
                        'tag' => 'all'
                        ,'component' => 'all'
                        ,'location' => 'demo/all/all'
                        ,'template' => 'demo/all/all.html'
                        ,'route' => ['/demo']
                    ]
                ];



            }


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
            $this->router->register('/quick');
            $this->router->register('/demo');

        }

        /**
         * In this function you can set global variables
         * that will exist across all application
         */
        public function globals(){
            $this->globals = [
                'team' => 'isaac'
            ];
        }


    }








$Application = new iApp();
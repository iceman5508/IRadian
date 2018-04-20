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
                $this->html = 'app';

                $this->components = [
                    'Hello' => [
                        'tag' => 'content'
                        ,'component' => 'home'
                        ,'location' => 'Hello/home'
                        ,'template' => 'Hello/home.html'
                        ,'route' => ['/home','/']
                    ]
                    ,'404' => [
                        'tag' => 'content'
                        ,'component' => 'fof'
                        ,'location' => 'notFound/fof'
                        ,'template' => 'notFound/404.html'
                        ,'route' => ['/404',]
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

        /**
         * In this function you can set global variables
         * that will exist across all application
         */
        public function globals(){
<<<<<<< HEAD

            $request = new \IEngine\ibase\iRequest();
            $url = \IEngine\ibase\iWeb::projectUrl();
            $request->get($url.'api/', ['api' => 'videos/getVideos']);
            $result =  json_decode($request->response(), true);




=======
>>>>>>> 2cc20c9749f936d4dbcbd422b7ecf8f93639ee61
            $this->globals = [

            ];
        }


    }








$Application = new iApp();
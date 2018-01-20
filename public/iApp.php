<?php
require_once '../bootstrap.php';
/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 1/13/2018
 * Time: 1:41 PM
 * The entry point for the application. Where components and the html page can be set.
 */
    class iApp extends \IRadian\ibase\iApplication
    {
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

        public function router(){
            $this->router->register('/');
            $this->router->register('/home');

        }


    }








$Application = new iApp();
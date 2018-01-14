<?php
require_once '../bootstrap.php';
/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 1/13/2018
 * Time: 1:41 PM
 * The entry point for the application. Where components and the html page can be set.
 */

//load in classes being used
use ITemplate\iExtends\iRouter;
use IEngine\ibase\iWeb;

//protect against illegal navigation
if(iRouter::routeLimit(2)){
    iredirect_to(iWeb::projectUrl());
}

//param for which view to show, turn it to true then reload page in browser
$strapView = false;

if(!$strapView) {
//include welcome component
    loadComponent('welcome/welcomeComponent', false);

//load in the template
    $welcome = new welcomeComponent('welcome/index.html');

//load in the template and set its tag
    \ITemplate\iExtends\iTags::setTag('welcome', $welcome);

//load in the template viewer
    $view = new \ITemplate\iExtends\iView();

//load the tag into the viewer
    $view->setTag('welcome');

//render the component
    $view->render();
}else {


    class iApp extends \IRadian\ibase\iApplication
    {
        public function main()
        {
            $this->html = 'index';

            $this->components = [
                'layout/header/header'
                , 'layout/content/content'
            ];

        }


    }

    $Application = new iApp();

}
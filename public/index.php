<?php

require_once '../bootstrap.php';

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
}else{

    class myViewManager extends \ITemplate\iExtends\viewManager
    {}


    loadComponent('layout/header/header', false);
    loadComponent('layout/content/content', false);

    $vm = new myViewManager('index.html');
    $vm->render();
}
<?php

require_once 'bootstrap.php';

//include welcome component
loadComponent('welcome/welcomeComponent', false);

//load in classes being used
use ITemplate\iExtends\iRouter;
use IEngine\ibase\iWeb;


//protect against illegal navigation
if(iRouter::routeLimit(2)){
    iredirect_to(iWeb::projectUrl());
}

//load in the template
$welcome = new welcomeComponent('welcome/index.html');

//load in the template and set its tag
\ITemplate\iExtends\iTags::setTag('welcome',$welcome);

//load in the template viewer
$view = new \ITemplate\iExtends\iView();

//load the tag into the viewer
$view->setTag('welcome');

//render the component
$view->render();
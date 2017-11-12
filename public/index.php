<?php

require_once '../bootstrap.php';

//include welcome component
require_once 'app/welcome/welcomeComponent.php';


//load in the template
$welcome = new welcomeComponent('welcome/index.html');

//load in the template
\ITemplate\iExtends\iTags::setTag('welcome',$welcome);

//load in the template viewer
$view = new \ITemplate\iExtends\iView();

//load the tag into the viewer
$view->setTag('welcome');

//render the component
$view->render();
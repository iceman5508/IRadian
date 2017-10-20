<?php

require_once '../bootstrap.php';
use ITemplate\iExtends\viewManager;
use ITemplate\iExtends\iRouter;

class main extends viewManager{

}


iRouter::runInstance('route');
iRouter::$route = '';


viewManager::registerComponent('header/header.php');
iRouter::call('about', 'about/about.php');

iRouter::scanner();
if(iRouter::$route!=''){
    main::router();
}else{
    viewManager::registerComponent('content/content.php');
}

viewManager::registerComponent('footer/footer.php');

$main = new main('index.html');

$main->render();

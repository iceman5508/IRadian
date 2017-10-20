<?php

require_once '../bootstrap.php';
use ITemplate\iExtends\viewManager;

class main extends viewManager{

}

viewManager::registerComponent('header/header.php');
viewManager::registerComponent('content/content.php');
viewManager::registerComponent('footer/footer.php');

$main = new main('index.html');

$main->render();

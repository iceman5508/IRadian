<?php
/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 1/20/2018
 * Time: 9:20 PM
 */
require_once 'bootstrap.php';
$apiVar = 'api';
$api = new api($apiVar);
$api->addResource(['test']);

if(isset($_REQUEST[$apiVar]))
{

    $api->pullRequests();


    switch($api->getApi()) {
        case '/test':
            $calledApi = new test($api->getFullResource());
            print $response =  $calledApi->response();
            break;
        default:
            print 'No Such Resource';
            break;
    }


}else{
    print 'No Resource Selected';
}
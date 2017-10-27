<?php

/**
 * User: Isaac Parker
 * Date: 10/20/2017
 * Time: 12:52 PM
 * The config class for project, this is a required setup
 */
use IEngine\ibase\iWeb;

define('PROJECT', iWeb::projectUrl());
define('LIBS', iWeb::projectUrl().'\libs');
define('VENDORS', iWeb::projectUrl().'\vendors');

class iConfig
{

    public static $project = [
        'title' => 'My Project'
        ,'author' => 'Isaac Parker'
    ];

    public static $database = [
         'host'  => 'localhost'
        ,'username' => 'root'
        ,'password' => ''
        ,'database' => 'testdb'
    ];

    public static $jquery = [
        'main' => PROJECT.'/vendors/jquery/jquery.js'
        ,'ui' =>   PROJECT.'/vendors/jquery/jquery-ui.min.js'
        ,'css' =>   PROJECT.'/vendors/jquery/jquery-ui.min.css'
    ];

    public static $bootstrap = [
        'main' =>  PROJECT.'/vendors/bootstrap/bootstrap.bundle.min.js'
        ,'css' =>  PROJECT.'/vendors/bootstrap/bootstrap.css'

    ];
}





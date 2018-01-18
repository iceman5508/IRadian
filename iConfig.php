<?php

/**
 * User: Isaac Parker
 * Date: 10/20/2017
 * Time: 12:52 PM
 * The config class for project, this is a required setup
 */
use IEngine\ibase\iWeb;

define('PROJECT', iWeb::projectUrl());
define('LIBS', BASEPATH.'\libs');
define('VENDORS', iWeb::projectUrl().'/vendors');

class iConfig
{

    public static $project = [
        'title' => 'Project Title'
        ,'author' => 'Author Name'
        ,'route_var' => 'route'
    ];

    public static $database = [
         'host'  => 'host'
        ,'username' => 'username'
        ,'password' => 'password'
        ,'database' => 'database'
    ];


}





<?php


use IEngine\ibase\iWeb;
define('PROJECT', iWeb::projectUrl());

define('LIBS', BASEPATH.'/libs');
define('VENDORS', iWeb::projectUrl().'vendors');

/**
 * Author: Isaac Parker
<br>
 * The config class for project, this is a required setup.
 * Through this class you can configure a lot of the project details.
 */
class iConfig
{

    /**This variable is used to setup
     * project detail as well as add any
     * variables you want exposed to the entire project.
     * @var array
     */
    public static $project = [
        'title' => 'IRadian'
        ,'author' => 'Isaac Parker'
        ,'route_var' => 'route'
    ];

    /**
     * The database variable. The information here
     * Is an can be used with code that connects to a database.
     * @var array
     */
    public static $database = [
         'host'  => 'localhost'
        ,'username' => 'root'
        ,'password' => ''
        ,'database' => 'demo'
    ];

    /**
     * This variable handles project security.
     * The route_limit variable handles how many slashes to allow in the url
     * @var array
     */
    public static $security = [
       'route_limit' => 2
    ];

    /**
     * Api variable handles all api details
     * var - The api query key to use when connecting to api
     * <br>
     * example if var = 'api':
     * http://site/api/?api=test/getTest
     *
     * The resources variable contain all api
     * you are using and going to connect to.<br>
     *
     *
     * @var array
     */
    public static $api = [
        'var' => 'api'
        ,'resources' => [
            'videos'

        ]
    ];


}





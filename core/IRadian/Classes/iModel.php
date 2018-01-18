<?php
/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 10/26/2017
 * Time: 4:01 PM
 */

namespace IRadian\ibase;


use IEngine\ibase\iAPi;

/**
 * Class iModel
 * Class for handling the model aspect of the application.
 *
 * Note ALL MODELS MUST RUN THE PARENT CONSTRUCTOR
 * @package IRadian\ibase
 */

abstract class iModel extends iAPi
{

    public function __construct($request)
    {
        parent::__construct($request);
    }

    public abstract function __destruct();
}
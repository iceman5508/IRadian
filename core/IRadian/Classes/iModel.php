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
 * @version 1.0<br>
 * Class iModel
 * Class for handling the model aspect of the application.
 *
 * Note ALL EXTENDED MODELS MUST RUN THE PARENT CONSTRUCTOR IF DEFAULT CONSTRUCTOR NOT USED
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
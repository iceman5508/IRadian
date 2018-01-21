<?php

/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 1/20/2018
 * Time: 10:50 PM
 */
class test extends \IRadian\ibase\iModel
{
  function __destruct()
  {
      // TODO: Implement __destruct() method.
  }

  public function __construct($request)
  {
      parent::__construct($request);
  }

  public function getTest(){
      return 'hi this is a test';
  }

}
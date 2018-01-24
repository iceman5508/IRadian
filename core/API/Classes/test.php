<?php

/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 1/20/2018
 * Time: 10:50 PM
 */
class test extends \IRadian\ibase\iModel
{
    private $users = array(
        array('name' => 'Call it what you want', 'video' => 'uEj8LqPi-nc')
       ,array('name' => 'Ready for it', 'video' => 'GZeza5xTeuM')
       ,array('name' => 'Immigrant Song', 'video' => 'y8OtzJtp-EM')
       ,array('name' => 'Beautiful Trauma', 'video' => '41taYOq1kVY')
    );
  function __destruct()
  {
      // TODO: Implement __destruct() method.
  }

  public function __construct($request)
  {
      parent::__construct($request);
  }

  public function getUser(){
      return $this->users;
  }

}
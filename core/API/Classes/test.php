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
        array('name' => 'Dancing Dog', 'video' => 'EcOE1ScBozI')
       ,array('name' => 'Funny Cats Dancing To Music', 'video' => 'RUStXqbydY')
       ,array('name' => 'Tony Baker Comedy Compilations 21 fav', 'video' => 'v3DsBIvz0-0')
       ,array('name' => 'What if you were a younger sibling of Jesus?', 'video' => 'LbP4KttZOcc')
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
<?php

/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 1/20/2018
 * Time: 10:50 PM
 */
class test extends \IRadian\ibase\iModel
{
    private $videos = array(
         array('name' => 'Dancing Dog', 'video' => 'EcOE1ScBozI')
       , array('name' => 'PSY - GANGNAM STYLE', 'video' => '9bZkp7q19f0')
       , array('name' => 'Tony Baker Comedy Compilations 21 fav', 'video' => 'v3DsBIvz0-0')
       ,array('name' => 'What if you were a younger sibling of Jesus?', 'video' => 'LbP4KttZOcc')
    );
  function __destruct()
  {
      // TODO: Implement __destruct() method.
      unset($this->videos);
  }

  public function __construct($request)
  {
      parent::__construct($request);
  }

  public function getVideos(){
      return $this->videos;
  }

}
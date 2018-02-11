<?php

/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 2/11/2018
 * Time: 10:59 AM
 *
 */

class table extends \IRadian\ibase\iTables
{
    public  function up(){
        $this->varchar('name');
        $this->varchar('comment');
    }

    public  function down(){

    }

}

class videos extends \IEngine\ibase\iAPi
{


    private $table;

    private $videos = array(
        array('name' => 'Dancing Dog', 'video' => 'EcOE1ScBozI',
            'desc' =>'Let us enjoy watching dancing dogs and shooting stars.' )
    , array('name' => 'PSY - GANGNAM STYLE', 'video' => '9bZkp7q19f0',
            'desc' =>'Greatest Dance in history')
    , array('name' => 'Tony Baker Comedy Compilations 35', 'video' => '8dsk4W39vNI'
        ,'desc' =>'When Animals talk')
    ,array('name' => 'What if you were a younger sibling of Jesus?', 'video' => 'LbP4KttZOcc'
        ,'desc' =>'James Christ..too funny!')
    );

    public function __construct($request){
       $this->table = new table('videos');
        parent::__construct($request);
    }

    public function post(){

       $video   = $this->properties[0];
       $comment = $this->properties[1];

       return $this->table->insert(array(
            'name' => $video
            ,'comment' => iescapeCode($comment)
        ));

    }

    public function getPosts($video){

    }

    public function getVideos(){
        return $this->videos;
    }

    public function __destruct()
    {
        unset($this->videos);
    }


}
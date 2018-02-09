<?php

/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 2/9/2018
 * Time: 1:02 AM
 */
class all extends \ITemplate\iExtends\iComponent
{


    public  function attributes()
    {
        $request = new \IEngine\ibase\iRequest();
        $request->get('http://localhost/IRadian/api/', ['api' => 'test/getVideos']);
        $this->videos = json_decode($request->response(), true);


    }
}
<?php

/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 2/8/2018
 * Time: 2:54 PM
 */
class current extends \ITemplate\iExtends\iComponent
{

    public $sel, $video;

    public  function attributes(){
            $this->selected();


    }

    private function selected(){
        if(isset($_GET['selected'])){
            $this->selected = true;
            $this->sel = $_GET['selected'];
            $videos = \IEngine\ibase\iGlobal::get('videos');
            $all = array_column($videos, 'video');
            $found_key = array_search($this->sel, $all);
            $this->video = $videos[$found_key];
        }

    }

}
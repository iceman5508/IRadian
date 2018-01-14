<?php
/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 1/13/2018
 * Time: 5:51 PM
 * Parse the loading html page before component data is loaded
 */

namespace IRadian\ibase;


class iRParser
{

    private $content;
    private $parsed;

    function __construct($content){
        $this->content = $content;
        $this->parsed =  array('ui'=> $this->parseUI(), 'config' => $this->parseConfig(), 'moduel' => $this->parseModuel());
    }

    function __destruct()
    {
        unset($this->content);
        unset($this->parsed);
    }


    /**
     * Parse UI loads
     * @return mixed
     */
    private function parseUI(){
        return $this->parser('ui');
    }

    /**
     * Parse Config loads
     * @return mixed
     */
    private function parseConfig(){
        return $this->parser('config');
    }

    /**
     * parse moduel loads
     * @return mixed
     */
    private function parseModuel(){
        return $this->parser('moduel');
    }

    /**
     * The parse function
     * @param $tag
     * @return mixed
     */
    private function parser($tag){
        $pattern = "/#$tag\[(.*?)\]/";
        preg_match_all($pattern, $this->content, $matches);
        return $matches[1];
    }

    /**
     * @return array
     */
    public function getParsed()
    {
        return $this->parsed;
    }

}
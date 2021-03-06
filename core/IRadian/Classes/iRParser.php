<?php

namespace IRadian\ibase;

/**
 * @version 1.0 <br>
 * Class iRParser - Handles the parsing of the main template file that
 * all components are loaded into.
 * <br>
 * Users will never interact with this file/class directly.
 * @package IRadian\ibase
 */
class iRParser
{
    /**
     * The content of the main html file
     * @var
     */
    private $content;

    /**
     * The parsed data from the main html file
     * @var array
     */
    private $parsed;

    /**
     * iRParser constructor. The entry point for the class.
     * @param $content - Takes in the content from the main html file.
     */
    function __construct($content){
        $this->content = $content;
        $this->parsed =  array('ui'=> $this->parseUI(), 'config' => $this->parseConfig(), 'module' => $this->parseModuel());
    }

    function __destruct()
    {
        unset($this->content);
        unset($this->parsed);
    }


    /**
     * Parse UI loads. Parse all ui specific keywords in the template.
     * @return mixed - An array of parsed UI call data.
     */
    private function parseUI(){
        return $this->parser('ui');
    }

    /**
     * Parse Config loads. Handle all Config calls in the template.
     * @return mixed - The parsed Config data.
     */
    private function parseConfig(){
        return $this->parser('config');
    }

    /**
     * parse moduel loads. Handle all moduel calls in the template.
     * @return mixed - The parsed moduel data.
     */
    private function parseModuel(){
        return $this->parser('module');
    }

    /**
     * The parse function. Handles all parsing in the template before passing to their
     * respective handlers for evaluation.
     * @param $tag - The tag to parse
     * @return mixed - Parsed data
     */
    private function parser($tag){
        $pattern = "/#$tag\[(.*?)\]/";
        preg_match_all($pattern, $this->content, $matches);
        return $matches[1];
    }

    /**
     * Return all parsed data
     * @return array - Array of parsed data
     */
    public function getParsed()
    {
        return $this->parsed;
    }

}
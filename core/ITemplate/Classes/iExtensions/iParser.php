<?php
/**
 * Created by PhpStorm.
 * User: iceman5508
 * Date: 1/2/2018
 * Time: 7:45 AM
 */

namespace ITemplate\iExtends;

class iParser
{
    private $content;
    private $functions;
    private $loops;
    private $component;
    private $ifs;

    function __construct($content,$component){
        $this->content = $content;
        $this->component = $component;
        $this->parseFunctions();
        $this->parseLoops();
        $this->parseIfs();



    }

    function __destruct()
    {
        unset($this->content);
        unset($this->functions);
        unset($this->loops);
        unset($this->ifs);
    }

    /**
     * Parse a particular tag
     * @param $tag
     * @return mixed
     */
    private function parseTag($tag) {
        $pattern = "/<$tag>(.*?)<\/$tag>/s";
        preg_match_all($pattern, $this->content, $matches);
        return $matches[1];
    }



    /**
     * Parse  the function associated with the iRFun tag
     */
    private function parseFunctions(){
        $this->functions = new iFunctions($this->parseTag("irFun"), $this->component);
        foreach ($this->functions->getFunctions() as $fun => $value){
            if (strpos($this->content, $fun) !== false) {
                $this->content = str_replace("<irFun>" . $fun . "</irFun>", $value, $this->content);
            }
        }
    }

    /**
     * Parse the loops associated with the irLoop tag
     */
    private function parseLoops(){
        $this->loops = new iloops($this->parseTag("irLoop"), $this->component);
        foreach ($this->loops->getLoops() as $loop => $value){
            if (strpos($this->content, $loop) !== false) {
                $this->content = str_replace(trim("<irLoop>" . $loop . "</irLoop>"), $value, trim($this->content));
            }
        }
    }

    /**
     * Parse the if associated with the irIf tag
     */
    private function parseIfs(){
        $pattern = "/#irIf(.*?)#/s";
        preg_match_all($pattern, $this->content, $matches);
        $matches = array_merge($matches[1], $this->parseTag('irIf'));
        $this->ifs = new iiF($matches, $this->component);
        foreach ($this->ifs->getIfs() as $if => $value){
            if (strpos($this->content, $if) !== false) {
                $this->content = str_replace(trim("#irIf" . $if . "#"), $value, trim($this->content));
                $this->content = str_replace(trim("<irIf>" . $if . "</irIf>"), $value, trim($this->content));
            }
        }
    }





    /**
     * @return mixed
     */
    public function getContent(){
        return $this->content;
    }




}
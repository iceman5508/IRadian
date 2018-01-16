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
    private $component;

  function __construct($content,$component){
      $this->content = $content;
      $this->component = $component;
      $this->parseFunctions();

  }

  function __destruct()
  {
     unset($this->content);
     unset($this->functions);
  }

    /**
     * Parse a particular tag
     * @param $tag
     * @return mixed
     */
  private function parseTag($tag) {
        $pattern = "/<$tag>(.*?)<\/$tag>/";
        //$content = str_replace(' ','',preg_replace('/\s+/','',$this->content));
        preg_match_all($pattern, $this->content, $matches);
        return $matches[1];
    }

    /**
     * Parse a the function accociated with the iRFun tag
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
     * @return mixed
     */
    public function getContent(){
        return $this->content;
    }




}
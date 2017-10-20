<?php
/**
 * Author Isaac Parker
 * Date 9-1-2017
 * Class iNumber
 * @package IEngine\ibase
 */
namespace IEngine\ibase;


class iNumber
{
    protected $number;

    public function __construct($number){
        if(is_numeric($number)){
            $this->number = $number;
        }
    }

    public function __destruct(){
        unset($this->number);

    }

    /**
     * Returns a rounded version of the number
     * @return int
     */
    public function round(){
        return round($this->number);
    }

    /**
     * Round the current number up
     * @return float
     */
    public function roundUp(){
        return ceil($this->number);
    }

    /**
     * Round the current down
     * @return float
     */
    public function roundDown(){
        return floor($this->number);
    }

    /**
     * Return the log of the number
     * @param int $base - the log base, NULL by default
     * @return float
     */
    public function log($base=NULL){
        if($base === NULL)
            return log($this->number);
        return log($this->number, $base);
    }

    /**
     * Return the powered value of the number
     * @param int $exp - the exponent ot multiply by
     * @return float
     */
    public function power($exp=2){
        return pow($this->number,$exp);
    }

    /**
     * Add two numbers together
     * @param $number
     * @return int|string
     */
    public function add($number){
        if($number instanceof iNumber) {
            $number = $number->getNumber();
        }
        return $this->number+$number;
    }

    /**
     * Multiply two numbers
     * @param $number
     * @return int|string
     */
    public function multiply($number){
        if($number instanceof iNumber) {
            $number = $number->getNumber();
        }
        return $this->number+$number;
    }

    /**
     * Subtract two numbers
     * @param $number
     * @return int|string
     */
    public function subtract($number){
        if($number instanceof iNumber) {
            $number = $number->getNumber();
        }
        return $this->number-$number;
    }

    /**Divide two numbers
     * @param $number
     * @return float|int
     */
    public function divide($number){
        if($number instanceof iNumber) {
            $number = $number->getNumber();
        }
        return $this->number/$number;
    }

    /**
     * Get a specific percent of the number
     * @param $number
     * @return float|int
     */
    public function percent($number){
        if($number instanceof iNumber) {
            $number = $number->getNumber();
        }
        return ($number/ 100) * $this->number;
    }

    /**
     * Get the value of a specific percentage oof the number
     * @param $number
     * @return int|string
     */
    public function percentOff($number){
        if($number instanceof iNumber) {
            $number = $number->getNumber();
        }
        return $this->number -(($number/ 100) * $this->number);
    }

    /**
     * Return the current number
     * @return int|string
     */
    public function getNumber(){
        return $this->number;
    }

    function __toString(){
        return "".$this->number;
    }

}
<?php
namespace IEngine\ibase;

/**
 * Created by PhpStorm.
 * User: parker10 aka Isaac Parker
 * Date: 5/27/2017
 * Time: 8:17 PM
 * Create a random token that is secure to be used.
 * This token can be limited in length as well.
 *
 * *Original Solution taken from here:
 * http://stackoverflow.com/a/13733588/1056679
 *
 * edited by Isaac Parker
 */
class iToken
{

    /** @var string */
    protected $alphabet;

    /** @var int */
    protected $alphabetLength;


    /**
     * @param string $alphabet
     */
    public function __construct($alphabet = ''){
        if ('' !== $alphabet) {
            $this->setAlphabet($alphabet);
        } else {
            $this->setAlphabet(
                implode(range('a', 'z'))
                . implode(range('A', 'Z'))
                . implode(range(0, 9))
            );
        }
    }

    public function __destruct(){
        unset($this->alphabet);
        unset($this->alphabetLength);
    }

    public function makeHash($string, $algo='sha256', $salt = '' ){
        if(strlen(trim($salt))<1){
            $salt = $this->generate(8);
            return [hash($algo, $string.$salt), $salt];
        }else
        return hash($algo, $string.$salt);
    }


    /**
     * @param string $alphabet
     */
    public function setAlphabet($alphabet){
        $this->alphabet = $alphabet;
        $this->alphabetLength = strlen($alphabet);
    }

    /**
     * @param int $length
     * @return string
     */
    public function generate($length){
        $token = '';
        for ($i = 0; $i < $length; $i++) {
            $randomKey = $this->getRandomInteger(0, $this->alphabetLength);
            $token .= $this->alphabet[$randomKey];
        }

        return substr(uniqid($token), 0, $length);
    }

    /**
     * @param int $min
     * @param int $max
     * @return int
     */
    private function getRandomInteger($min, $max)
    {
        $range = ($max - $min);

        if ($range < 0) {
            // Not so random...
            return $min;
        }

        $log = log($range, 2);

        // Length in bytes.
        $bytes = (int) ($log / 8) + 1;

        // Length in bits.
        $bits = (int) $log + 1;

        // Set all lower bits to 1.
        $filter = (int) (1 << $bits) - 1;

        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));

            // Discard irrelevant bits.
            $rnd = $rnd & $filter;

        } while ($rnd >= $range);

        return ($min + $rnd);
    }




}
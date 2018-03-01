<?php

namespace IEngine\ibase;

/**
 * @version 1.0<br>
 * This class handles the retrieval of form data.
 * Class iForm
 * @package IEngine\ibase
 */
class iForm
{
    private $submit, $iArray;

    /**
     * iForm constructor. The entry point into the class.
     */
    public function __construct(){
        $this->submit = $this->setFormData();
    }

    function __destruct() {
        unset($this->submit);
        unset($this->iArray);
    }

    /**
     * Returns the data associated with a specific form field
     * @param $fieldName - the name of the field to be checked
     * @return mixed - returns field data
     */
    public function getData($fieldName){
        return $this->iArray[$fieldName];
    }

    /**
     * Check if the form was properly submited or not
     * @return bool
     */
    public function isSubmit(){
        return $this->submit;
    }

    /**
     * Check if a specific field is empty or not
     * @param $fieldName - The name of the form field to check
     * @return bool
     */
    public function isFieldEmpty($fieldName){
        if(strlen(trim($this->getData($fieldName)))<1) {
            return true;
        }else {
            return false;
        }
    }

    /**
     * Check the length of a particular field
     * @param $fieldName - the name of the field to check
     * @return int - the length of the field data
     */
    public function getDataCount($fieldName){
        return strlen($this->getData($fieldName));
    }

    /**
     * Compare if two form fields are equal
     * @param $fieldName1 - the first field to check
     * @param $fieldName2 - the second field to check
     * @return bool
     */
    public function compareFields($fieldName1,$fieldName2)
    {
        if(strcasecmp ( $this->getData($fieldName1) , $this->getData($fieldName2))==0) {
            return true;
        }else {
            return false;
        }
    }


    /**
     * Return the complete form data
     * @return mixed
     */
    public function getFormData(){
        return $this->iArray;
    }

    private function setFormData(){
        if(!empty($_REQUEST)){
            foreach($_REQUEST AS $key => $value) {
                $this->iArray[$key] =$value;
            }
        }else { return false; }
        return true;
    }


}
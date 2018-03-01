<?php

namespace IEngine\iExtends;
use IEngine\ibase\iDatabase;
use IEngine\ibase\iForm;
use IEngine\ibase\iSession;
use IEngine\ibase\iToken;

/**
 * @version 1.0<br>
 * This class is used to validate form data prior to submitting the data into a database.
 * Class iFormValidate
 * @package IEngine\iExtends
 */
class iFormValidate
{
    private $db, $errors=array(), $isValid = false;

    /**
     * iFormValidate constructor.
     */
    function __construct(){
        $this->db = iDatabase::getInstance();
    }

    function __destruct(){
        unset($this->db);
        unset($this->errors);
        unset($this->isValid);
    }

    /**
     * Return the valid value of the validation process
     * @return bool
     */
    public function isValid(){
        return $this->isValid;
    }

    /**
     * Validate the form
     * @param $type - $_POST or $_GET
     * @param $fieldData - The rules to follow with the validation
     * @param $checkName - The initial check name to run across, recommend the use of the form's submit button here
     */
    public function validate($type, $fieldData = array(), $checkName ){
        $dbFieldName = false;
        $table=false;
        if(isset($type[$checkName])){
            $formData = new iForm();
            foreach($fieldData as $fieldName => $rules) {
                if(isset($rules['refName'])&& !empty($rules['refName'])) {
                    foreach($rules as $rule => $data) {
                    $fieldValue = $formData->getData($fieldName);

                        $refName = $rules['refName'];
                        switch($rule) {
                            case 'dataType':
                                    if (!ivalid_dataType($data,$fieldValue)){
                                      $this->errors[] = "{$refName} is not of type {$data}";
                                    }
                            break;
                            case 'min':
                                if($formData->getDataCount($fieldName) < $data) {
                                    $this->errors[] = "{$refName} must be at least {$data} characters.";
                                }
                                break;
                            case 'max':
                                if($formData->getDataCount($fieldName) >$data) {
                                    $this->errors[] = "{$refName} must be at most {$data} characters.";
                                }
                                break;
                            case 'required':
                                if($formData->isFieldEmpty($fieldName)){
                                    $this->errors[] = "{$refName} is required. ";
                                }
                                break;
                            case 'matchField':
                                if($fieldValue === $formData->getData($data)){}
                                else{ $this->errors[] = "{$refName} do not match."; }
                                break;
                            case 'dbTbl':
                                $table = $data;
                                break;
                            case 'tblColName':
                                $dbFieldName = $data;
                                break;
                            case 'tblUnique':
                                if($table !== false ){
                                if($dbFieldName !== false){
                                        $check = $this->db->getQuery($table , array($dbFieldName ,"=", iescapeCode($fieldValue)));
                                        if($check!==false){
                                            if( $check->count()) {
                                                if($data===true){
                                                    $this->errors[] = "This {$refName} is already taken.";
                                                }
                                            }else{
                                                if($data===false){
                                                    $this->errors[] = "No match to {$refName} found.";
                                                }
                                            }
                                        }else { $this->errors[] = "tblUnique could not be executed, 
                                                                please check table or field name"; }
                                    } else{
                                      $this->errors[] = "tblColName must be set!";
                                    }
                                }else{  $this->errors[] = "dbTbl must be set!"; }
                                break;
                            default:
                                break;
                        }
                    }
                   $dbFieldName = false;
                    $table = false;
                }else{
                    $this->errors[] = "{$fieldName} requires a reference name.";
                    break;
                }
            }
            if(empty($this->error)) {
                $this->isValid = true;

            }else{
                $this->isValid=false;
            }
        }else{
            $this->errors[] = "{$checkName} was not found";
            $this->isValid = false;
        }
        if(count($this->errors) > 0){
            $this->isValid = false;
        }
    }


    /**
     * Return all errors related in validation
     * @return array
     */
    public function getErrors(){
        return $this->errors;
    }


    /**
     * generate a token
     * @param $tokenName - The name of thee token to generate
     * @return string
     */
    final public static function makeToken($tokenName){
        $token = new iToken();
        $token = $token->makeHash($token->generate(irand_num(4,16)));
        iSession::set($tokenName,  $token[0]);
        return iSession::get($tokenName);
    }

    /**
     * Check to see if a token given exists
     * @param $tokenName - The name of the token to check for
     * @return bool
     */
    final public static function checkToken($tokenName){
        if(iSession::exists($tokenName) &&   $_REQUEST[$tokenName] === iSession::get($tokenName)){
            iSession::delete($tokenName);
            return true;
        }
        return false;

    }


   


}
<?php
/**
 * Created by PhpStorm.
 * User: Isaac Parker
 * Date: 9-3-2017
 * Time: 7:54 PM
 */

/*****************************************Creditcard validation***********************************/
/****************Valid credit card number***************/
if(!function_exists('ivalid_ccnum')) {
    function ivalid_ccnum($str){
        return preg_match('/^\d{16}$/' ,$str);
    }
}

/****************valid experation date*************/
if(!function_exists('ivalid_cexp')) {
    function ivalid_cexp($str){
        return preg_match('/(0[1-9]|1[0-2])\/20[0-9]{2}$/', $str);
    }
}

/****************************************Validate phone numbers***************************************/
/************International numbers********************/
if(!function_exists('ivalid_int')) {
    function ivalid_int($str){
        return preg_match('/^(\+|00)[1-9]{1,3}(\.|\s|-)?([0-9]{1,5}(\.|\s|-)?){1,3}$/', $str);
    }
}

/*************American Num**************************/
if(!function_exists('ivalid_usnum')) {
    function ivalid_usnum($str){
        return preg_match('/^[2-9]\d{2}-\d{3}-\d{4}$/', $str);
    }
}

/****************India Num**************************/
if(!function_exists('ivalid_indinum')) {
    function ivalid_indinum($str){
        return preg_match('/^\(0\d{2}\)\s?\d{8}$/', $str);
    }
}

/**********************************************US social security*******************/
/****Valid united states social security number**/
if(!function_exists('ivalid_ssn')) {
    function ivalid_ssn($str){
        return preg_match('/^\d{3}\-\d{2}\-\d{4}$/', $str);
    }
}

/***********************Valid Email**************/
/****Valid email**/
if(!function_exists('ivalid_email')) {
    function ivalid_email($str){
        return preg_match('/^([a-z0-9_-])+([\.a-z0-9_-])*@([a-z0-9-])+(\.[a-z0-9-]+)*\.([a-z]{2,6})$/', $str);
    }
}

/***********************Valid url********************/
if(!function_exists('ivalid_url')) {
    function ivalid_url($str){
        return preg_match('/^(http|https|ftp):\/\/([a-z0-9]([a-z0-9_-]*[a-z0-9])?\.)+[a-z]{2,6}\/?([a-z0-9\?\._-~&#=+%]*)?/', $str);
    }
}


/***********************Is image******************/
/****Note is image only check for basic image files*
if you wish to create a full proof image checker that goes beyond just
the basic file names you can extend the function*****/
if(!function_exists('is_image')) {
    function is_image($value){
        if(strpos($value, '.jpeg')!==false) {
            if(substr($value, -5) == '.jpeg') {
                return true;
            }else return false;
        } else if(strpos($value,'.jpg')!==false) {
            if(substr($value, -4) == '.jpg') {
                return true;
            }else return false;
        }
        else if(strpos($value,'.bmp')!==false) {
            if(substr($value, -4) == '.bmp') {
                return true;
            }else return false;
        }else if( strpos($value,'.png')!==false) {
            if(substr($value, -4) == '.png') {
                return true;
            }else return false;
        }else if(strpos($value,'.gif')!==false) {
            if(substr($value, -4) == '.gif') {
                return true;
            }else return false;
        }else return false;
    }
}

/***********************Is textfile******************/
if(!function_exists('is_textfile')) {
    function is_textfile($file){
        if(strpos($file, '.txt')!==false) {
            if(substr($file, -4) == '.txt') {
                return true;
            }else return false;
        }
        else return false;
    }
}


/************is MP3*********/
/*Method Name: is MP3
 *Puropse: Search a file and check if specific item is an mp3 file
 *Precondition: folder must exsist
 *PostCondition: return true or false
 */
if(!function_exists('is_mp3')) {
    function is_mp3($file){
        if(strpos($file, '.mp3')!==false) {
            if(substr($file, -4) == '.mp3') {
                return true;
            }else return false;
        }
        else return false;
    }
}

/************iscsv*********/
/*Method Name: is_csv
 *Puropse: Search a file and check if specific item is an csv file
 *Precondition: folder must exsist
 *PostCondition: return true or false
 */
if(!function_exists('is_csv')) {
    function is_csv($file){
        if(strpos($file, '.csv')!==false) {
            if(substr($file, -4) == '.csv') {
                return true;
            }else return false;
        }
        else return false;
    }
}



/************isempty*********/
/*Method Name: is_empty
 *Puropse: Search a file and check if specific item is empty or not
 *Precondition:
 *PostCondition: return true or false
 */
if(!function_exists('is_empty')) {
    function is_empty($data){
        if(is_array($data)) {
            return (sizeof($data)>0 ? true: false);

        }
        if(is_string($data)) {
            return (preg_match('/\S/', $data) ? false: true);

        }
        return true;
    }
}


/*Is url function */
if(!function_exists('is_url')) {
    function is_url($url){
        if (preg_match('/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i', $url)) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * Validate a datatype
 * @param $type
 * @param $value
 * @return bool
 */
function ivalid_dataType($type, $value){
    $valid = false;
    switch ($type){
        case 'bool':
            is_bool($value)? $valid = true : $valid=false;
            break;
        case 'string':
            is_string($value)? $valid = true : $valid=false;
            break;
        case 'number':
            is_numeric($value)? $valid = true : $valid=false;
            break;
        case 'array':
            is_array($value)? $valid = true : $valid=false;
            break;
        default:
            break;
    }
    return $valid;
}


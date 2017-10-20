<?php
/**
 * Created by PhpStorm.
 * User: Isaac Parker
 * Date: 8/29/2017
 * Time: 10:57 PM
 */


/**
 * Redirects the user ti the url provided
 * @param location the redirect should take you to
 */
if(!function_exists('iredirect_to')){
    function iredirect_to( $location = NULL ) {
        if ($location != NULL) {
            header("Location: {$location}");
            exit;
        }
    }
}

/**
 * Sends an email to the address provided
 * @param email address is going to be sent to $To
 * @param sublect of the email $subject
 * @param the messgae $Message
 * @param who is the email from $FromMessage
 * returns bool - true if sent, false if not sent
 */
if(!function_exists('isend_mail')) {
    function isend_mail($To, $subject,$Message, $FromMessage){
        if(mail($To, $subject, $Message, "From:" . $FromMessage)) {
            return true;
        }
        else {
            return false;
        }
    }
}


?>
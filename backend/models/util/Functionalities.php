<?php
/**
 * Created by IntelliJ IDEA.
 * User: root
 * Date: 18/5/16
 * Time: 12:21 AM
 */

namespace backend\models\util;

use app\models\ErrorLog;
use app\models\ExceptionLog;
use app\models\MailLog;
use Yii;

class Functionalities
{
    /**
     * Sending Mail from system
     * @param $email
     * @param $mail_theme
     * @param $subject
     * @param null $data
     */
    public static function sendMail($email,$mail_theme,$subject,$data=null)
    {
        try {

            $check = Yii::$app->mailer->compose($mail_theme, ['data' => $data])
                ->setFrom('your.mail@id')
                ->setTo($email)
                ->setSubject($subject)
                ->send();

            $data = array();
            $data['to'] = $email;
            $data['subject'] = $subject;
            $data['data'] = implode(",",$data);
            $data['status'] = $check ? 1 : 0;
            $mail_log = new MailLog();
            $mail_log->createMailLog($data);
        }catch(\ErrorException $e) {

            $exception_log = new ExceptionLog();
            $exception_log->createException(__FUNCTION__,__CLASS__,$e);
        }
    }


    /**
     * this method is used for checking whether the required fields are present or not if yes return true
     * @param $my_object
     * @param $required_fields
     * @return array
     */
    public static function checkRequiredFieldsPresent($my_object, $required_fields)
    {
        try {
            if ($my_object === NULL)
                return false;

            if (count(array_diff($required_fields, array_keys($my_object))) == 0) {

                foreach ($required_fields as $key)
                    if ($my_object[$key] == "") {
                        return array($key);
                    }
                return true;
            } else {

                return array('Keys' => implode(",", array_diff($required_fields, array_keys($my_object))));
            }
        } catch(\ErrorException $e) {

            $exception_log = new ExceptionLog();
            $exception_log->createException(__FUNCTION__,__CLASS__,$e);
        }
    }


    /**
     * Get Response Array object as per response to API
     * @param $my_object
     * @param $keys {required keys return to APIs}
     * @return array with required attributes
     */
    public static function getResponseObject($my_object, $keys)
    {
        try {

            $response_object = array();

            foreach ( $keys as $key ) {

                if( array_key_exists($key,$my_object) )
                    $response_object[$key] = $my_object[$key];
                else {

                    $response_object[$key] = null;
                    $error_log = new ErrorLog();
                    $error_log->createError(__FUNCTION__,__CLASS__,$key . " not present");
                }
            }
            return $response_object;
        } catch (\ErrorException$e) {


            var_dump($e->getMessage());
            $exception_log = new ExceptionLog();
            $exception_log->createException(__FUNCTION__,__CLASS__,$e);
            return false;
        }
    }

    /**
     * Get Response Array object as per response to API
     * @param $my_object
     * @param $keys
     * @return array
     */
    public static function getResponseArrayObject($my_object,$keys)
    {
        try {

            $return_array = array();
            foreach($my_object as $key => $value)
            {

                $return_object = Functionalities::getResponseObject($my_object[$key],$keys);
                array_push($return_array,$return_object);
            }
            return $return_array;
        } catch(\ErrorException $e) {

            $exception_log = new ExceptionLog();
            $exception_log->createException(__FUNCTION__,__CLASS__,$e);
        }
    }
}
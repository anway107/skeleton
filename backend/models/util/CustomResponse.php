<?php
/**
 * Created by IntelliJ IDEA.
 * User: root
 * Date: 13/5/16
 * Time: 3:47 PM
 */

namespace backend\models\util;


use app\models\ExceptionLog;
use yii\base\ErrorException;
use Yii;
use yii\console\Response;


class CustomResponse
{
    /**
     * @param $my_object
     * @param $keys {required keys return to APIs}
     * @return array with required attributes
     */
    public static function getResponseObject($my_object, $keys)
    {
        try {

            $response_object = array();
            foreach ($keys as $key) {
                if( array_key_exists($key,$my_object) )
                    $response_object[$key] = $my_object[$key];
                else
                    $response_object[$key] = null;
            }
            return $response_object;
        } catch (ErrorException $e) {

            $exception_log = new ExceptionLog();
            $exception_log->createException(__FUNCTION__,__CLASS__,$e);
        }
    }


    public static function createResponse($message,$statuscode,$data=null)
    {
        try {

            if(gettype($statuscode) != 'integer') {

                Yii::$app->response->statusCode = StatusCodes::INTERNAL_SERVER_ERROR;

                $res = array(
                    'Message' => CustomMessages::WRONG_STATUS,
                    'Result' => $data
                );
                return $res;
            }

            Yii::$app->response->statusCode = $statuscode;
            $res = array(
                'Message' => $message,
                'Result' => $data
            );
            return $res;
        }catch(\ErrorException $e) {

            $exception_log = new ExceptionLog();
            $exception_log->createException(__FUNCTION__,__CLASS__,$e);
        }
    }
}
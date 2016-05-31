<?php
/**
 * Created by IntelliJ IDEA.
 * User: root
 * Date: 25/5/16
 * Time: 4:38 PM
 */

namespace backend\models\util;


use app\models\ExceptionLog;
use app\models\SystemUser;

class ApiAccess
{
    const GET_ALL_USERS = 1;

    public static function checkAccess($api_no,$user_type)
    {
        try {

            switch($api_no) {

                case self::GET_ALL_USERS:
                    if( $user_type == UserTypes::SYSTEM_USER )
                        return true;
                    else
                        return false;
                    break;
                default:
                    return false;

            }

        }catch(\ErrorException $e) {

            $exception_log = new ExceptionLog();
            $exception_log->createException(__FUNCTION__,__CLASS__,$e);
        }
    }
}
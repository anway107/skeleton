<?php
/**
 * Created by IntelliJ IDEA.
 * User: root
 * Date: 25/5/16
 * Time: 1:53 PM
 */

namespace backend\models\util;

use app\models\ExceptionLog;
use Faker\Provider\nl_NL\Payment;

class Sessions extends \yii\redis\ActiveRecord implements StatusCodes
{
    public function attributes()
    {
        return ['id','user_id', 'auth_token','user_type'];
    }

    /**
     * Adding the entry for session
     * @param $data
     * @return bool
     */
    public function makeEntry($data)
    {
        try {

            $result = Functionalities::checkRequiredFieldsPresent($data,RequestResponseFields::$SESSION_REQUIRED_FIELDS);

            if( $result === true  ) {

                $session = Sessions::find()->where(['user_id' => $data['user_id']])->one();

                if ($session == null) {

                    $this['user_id'] = $data['user_id'];
                    $this['auth_token'] = $data['auth_token'];
                    $this['user_type'] = $data['user_type'];

                    if ($this->save()) {

                        return true;
                    } else
                        return false;
                } else {

                    $session['auth_token'] = $data['auth_token'];

                    if ($session->save())
                        return true;
                    else
                        return false;
                }
            } else {

                return false;
            }
        }catch (\ErrorException $e) {

            $exception_log = new ExceptionLog();
            $exception_log->createException(__FUNCTION__,__CLASS__,$e);
            return false;
        }
    }

    /**
     * @param $auth_token
     * @return Number
     */
    public function getEntry($auth_token,$api_no) {

        try {

            $user = Sessions::find()->where(
                ['auth_token' => $auth_token]
            )->one();

            if ($user === null)
                return false;
            else {

                if( ApiAccess::checkAccess($api_no,$user['user_type']) )
                    return $user['user_id'];
                else
                    return false;
            }
        } catch(\ErrorException $e) {

            $exception_log = new ExceptionLog();
            $exception_log->createException(__FUNCTION__,__CLASS__,$e);
            return false;
        }
    }

    public function getAllEntries()
    {
        try {

            $users = Sessions::find()->asArray()->all();
            $response = Functionalities::getResponseArrayObject($users,RequestResponseFields::$SESSION_RESPONSE_FIELDS);
            return CustomResponse::createResponse(CustomMessages::SUCCESS,$this::OK,$response);
        }catch(\ErrorException $e) {

            $exception_log = new ExceptionLog();
            $exception_log->createException(__FUNCTION__,__CLASS__,$e);
        }
    }
}
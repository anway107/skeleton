<?php
/**
 * Created by IntelliJ IDEA.
 * User: root
 * Date: 25/5/16
 * Time: 11:41 AM
 */

namespace backend\models\util;


class RequestResponseFields
{

//        UserSignUp
    public static $USER_SIGN_UP_REQUEST = array('email','password','name');

    public static $USER_SIGN_UP_RESPONSE = array('id','username');

//    Required field for sessions

    public static $SESSION_REQUIRED_FIELDS = array('user_type','user_id','auth_token');

    public static $SESSION_RESPONSE_FIELDS = array('user_type','user_id','auth_token','check');

}

<?php
/**
 * Created by IntelliJ IDEA.
 * User: root
 * Date: 20/5/16
 * Time: 2:10 PM
 */

namespace backend\models\util;


class CustomMessages
{
    const WRONG_STATUS = "wrong status code";

    const SUCCESS = "Success";

    const ERROR = "Error";

    const AUTH_TOKEN_NOT_VALID = "Authentication token is expired,Please sign in again";

    const REQUIRED_KEYS_ARE_NOT_PRESENT = "Required keys are not present or blank";

    const DATABASE_TABLE_NOT_UPDATED = "Database table not updated";


    public static $UNAUTHORIZED_MESSAGE = array('Error' => 'Authentication token is not valid');
}
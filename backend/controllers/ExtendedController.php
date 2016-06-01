<?php
/**
 * Created by IntelliJ IDEA.
 * User: root
 * Date: 1/6/16
 * Time: 4:48 PM
 */

namespace backend\controllers;


use backend\models\util\StatusCodes;
use yii\web\Controller;

class ExtendedController extends Controller implements StatusCodes
{
    /**
     * Adding permission for the cross origin requests
     * @return mixed
     */
    public function behaviors()
    {
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Max-Age' => 86400,
            ],
        ];
        return $behaviors;
    }
}
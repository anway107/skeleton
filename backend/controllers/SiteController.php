<?php
namespace backend\controllers;

use app\models\ExceptionLog;
use app\models\SystemUser;
use backend\models\util\ApiAccess;
use backend\models\util\CustomMessages;
use backend\models\util\CustomResponse;
use backend\models\util\Functionalities;
use backend\models\util\RequestResponseFields;
use backend\models\util\Sessions;
use backend\models\util\StatusCodes;
use backend\models\util\UserTypes;
use Yii;
use yii\web\Controller;


/**
 * Site controller
 */
class SiteController extends Controller implements StatusCodes
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

    public function actionTesting()
    {
        try {

            return CustomResponse::createResponse(CustomMessages::SUCCESS,$this::OK);
        }catch(\ErrorException $e) {

            $exception_log = new ExceptionLog();
            $exception_log->createException(__FUNCTION__,__CLASS__,$e);
            return CustomResponse::createResponse($e->getMessage(),$this::INTERNAL_SERVER_ERROR);
        }
    }


}

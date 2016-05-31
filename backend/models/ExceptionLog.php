<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;


/**
 * This is the model class for table "exception_log".
 *
 * @property integer $id
 * @property string $exception
 * @property string $function
 * @property string $stacktace
 * @property string $created_at
 * @property string $updated_at
 */
class ExceptionLog extends \yii\db\ActiveRecord
{
    /**
     * Behaviour for setting the created_at and updated_at fields
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exception_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['classname'],'required'],
            [['stacktace'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['exception', 'function'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'exception' => 'Exception',
            'function' => 'Function',
            'stacktace' => 'Stacktace',
            'classname' => 'Classname',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function createException($function_name,$class_name,$e)
    {
        try {

            $this->exception = $e->getMessage();
            $this->stacktace = $e->getTraceAsString();
            $this->function = $function_name;
            $this->classname = $class_name;

            if( $this->save() ) {

            } else {

                $error_log = new ErrorLog();
                $error_log->createError(__FUNCTION__,__CLASS__,implode(",",$this->getFirstErrors()));
            }
        }catch(\ErrorException $e) {

            $exception_log = new ExceptionLog();
            $exception_log->createException(__FUNCTION__,__CLASS__,$e);
        }
    }
}

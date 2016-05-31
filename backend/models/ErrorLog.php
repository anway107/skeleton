<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;


/**
 * This is the model class for table "error_log".
 *
 * @property integer $id
 * @property string $error
 * @property string $function
 * @property string $class
 * @property string $created_at
 * @property string $updated_at
 */
class ErrorLog extends \yii\db\ActiveRecord
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
        return 'error_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['error', 'function', 'class'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'error' => 'Error',
            'function' => 'Function',
            'class' => 'Class',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function createError($function_name,$class_name,$message)
    {
        try {

            $this->error = $message;
            $this->function = $function_name;
            $this->class = $class_name;
            $this->save();
        }catch(\ErrorException $e) {

            $exception_log = new ExceptionLog();
            $exception_log->createException(__FUNCTION__,__CLASS__,$e);
        }
    }
}

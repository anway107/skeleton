<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;


/**
 * This is the model class for table "mail_log".
 *
 * @property integer $id
 * @property string $subject
 * @property string $to
 * @property string $data
 * @property string $created_at
 * @property string $updated_at
 */
class MailLog extends \yii\db\ActiveRecord
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
        return 'mail_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data'], 'string'],
            [['created_at', 'updated_at','status'], 'safe'],
            [['subject', 'to'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subject' => 'Subject',
            'to' => 'To',
            'data' => 'Data',
            'status' => 'Stauts',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function createMailLog($data)
    {
        try {

            $this->attributes = $data;

            if( $this->save() ) {

            }  else {

                $error_log = new ErrorLog();
                $error_log->createError(__FUNCTION__,__CLASS__,implode(",",$this->getFirstErrors()));
            }
        }catch(\ErrorException $e) {

            $exception_log = new ExceptionLog();
            $exception_log->createException(__FUNCTION__,__CLASS__,$e);
        }
    }
}

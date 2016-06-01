<?php
/**
 * Created by IntelliJ IDEA.
 * User: root
 * Date: 1/6/16
 * Time: 4:52 PM
 */

namespace backend\models\util;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class ExtendedActiveRecord extends \yii\db\ActiveRecord implements StatusCodes
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
}
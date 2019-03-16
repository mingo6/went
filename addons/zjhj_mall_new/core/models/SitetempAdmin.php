<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%sitetemp_admin}}".
 */
class SitetempAdmin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sitetemp_admin}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uniacid'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uniacid' => '公众号ID',
            'openid' => 'openid'
        ];
    }
}

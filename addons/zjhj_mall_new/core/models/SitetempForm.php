<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%sitetemp_form}}".
 */
class SitetempForm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sitetemp_form}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uniacid', 'createtime', 'isread'], 'required'],
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
            'data' => '内容',
            'createtime' => '创建时间',
            'isread' => '1已读 0未读',
        ];
    }
}

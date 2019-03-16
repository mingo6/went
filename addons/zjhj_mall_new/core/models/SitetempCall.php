<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%site_card_call}}".
 */
class SitetempCall extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%site_card_call}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uniacid', 'user_id','call_id','addtime','call_type'], 'required'],
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
            'user_id' => '点赞人ID',
            'call_id' => '被赞人名片IDS',
            'addtime' => '添加时间',
            'call_type' => '1 靠谱打call 2 签名打call',
        ];
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%home_block}}".
 *
 */
class ChargeGive extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%charge_give}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['store_id', 'charge_num', 'send_num'], 'required'],
            [['store_id', 'addtime'], 'integer'],
            [['charge_num', 'send_num'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'store_id' => 'Store ID',
            'charge_num' => '充值金额',
            'send_num' => '赠送金额',
            'addtime' => 'Addtime',
        ];
    }
}

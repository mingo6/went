<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%level}}".
 *
 * @property integer $id
 * @property integer $store_id
 * @property string $user_id
 * @property integer $money
 * @property integer $order_id
 * @property integer $addtime
 */
class BuyLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%buy_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['store_id','add_time','order_id'], 'integer'],
            [['money'], 'number'],
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
            'money' => '消费金额',
            'user_id' => '用户 ID',
            'order_id' => '订单 ID',
            'add_time' => 'Addtime',
        ];
    }
}

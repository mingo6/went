<?php

namespace app\models;

use Yii;

class GoodsLevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_level}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['store_id', 'goods_id', 'level_id'], 'required'],
            [['store_id', 'goods_id', 'level_id'], 'integer'],
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
            'goods_id' => '商品ID',
            'level_id' => '会员等级ID',
        ];
    }

    /**
     * 修改商品
     * @return array
     */
    public function saveGoodsLevel()
    {
        if ($this->validate()) {
            if ($this->save()) {
                return [
                    'code' => 0,
                    'msg' => '成功'
                ];
            } else {
                return [
                    'code' => 1,
                    'msg' => '失败'
                ];
            }
        } else {
            return (new Model())->getModelError($this);
        }
    }
}

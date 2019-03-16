<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/8/7
 * Time: 12:59
 */

namespace app\modules\mch\models;

use app\models\GoodsLevel;


class GoodsLevelForm extends Model
{
    public $goodsLevel;

    public $id;
    public $store_id;
    public $goods_id;
    public $level_id;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['store_id', 'goods_id', 'level_id'], 'number'],
            [['store_id', 'goods_id', 'level_id'], 'required'],
            [['store_id', 'goods_id', 'level_id'], 'default'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'store_id' => 'Store ID',
            'goods_id' => '商品',
            'level_id' => '会员等级',
        ];
    }

    /**
     * 编辑
     * @return array
     */
    public function save()
    {
        if ($this->validate()) {
            $goodsLevel = $this->goodsLevel;
            $_this_attributes = $this->attributes;
            $query = GoodsLevel::find()->where(['goods_id' => $_this_attributes['goods_id'], 'level_id' => $_this_attributes['level_id'], 'store_id' => $_this_attributes['store_id']]);
            if($_this_attributes['goodsLevel']['id'] > 0){
                $query->andWhere(['!=', 'id', $_this_attributes['goodsLevel']['id']]);
            }
            $exists = $query->one();
            if($exists){
                return [
                    'code' => 1,
                    'msg' => '已经添加过了！',
                ];
            }
            $goodsLevel->attributes = $_this_attributes;
            if ($goodsLevel->save()) {
                return [
                    'code' => 0,
                    'msg' => '保存成功',
                ];
            } else {
                return $this->getModelError($goodsLevel);
            }
        } else {
            return $this->getModelError();
        }
    }
}
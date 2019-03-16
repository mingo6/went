<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%sitetemp_temp}}".
 */
class SitetempTemp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sitetemp_temp}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uniacid', 'createtime', 'number', 'isact'], 'required'],
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
            'createtime' => '创建时间',
            'name' => 'name',
            'number' => '排序 越大越前',
            'img' => '图标',
            'isact' => '0未使用 1使用中',
            'issystem' => '是否系统模板 0不是 1是 系统模板不能删除修改',
            'issetsystem' => '是否平台自己设置的系统模板 0不是 1是的',
        ];
    }
}

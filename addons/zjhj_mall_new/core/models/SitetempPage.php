<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%sitetemp_page}}".
 */
class SitetempPage extends \yii\db\ActiveRecord
{

    const SCENARIO_EDIT = 'edit';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sitetemp_page}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uniacid', 'createtime', 'tempid'], 'required'],
        ];
    }

    //安全属性场景
    // public function scenarios()
    // {
    //     return [
    //         self::SCENARIO_EDIT => ['uniacid', 'params', 'createtime' , 'name' , 'tempid'],
    //     ];
    // }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uniacid' => '公众号ID',
            'params' => '内容',
            'createtime' => '创建时间',
            'name' => '备注页面名称',
            'tempid' => '对应的模板id'
        ];
    }
}

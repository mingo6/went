<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%sitetemp_bar}}".
 */
class SitetempBar extends \yii\db\ActiveRecord
{

    const SCENARIO_EDIT = 'edit';


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sitetemp_bar}}';
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
    //         self::SCENARIO_EDIT => ['uniacid', 'data', 'createtime' , 'tempid'],
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
            'data' => '内容',
            'createtime' => '创建时间',
            'tempid' => '对应的模板id'
        ];
    }
}

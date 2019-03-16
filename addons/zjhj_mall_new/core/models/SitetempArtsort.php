<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%sitetemp_artsort}}".
 */
class SitetempArtsort extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sitetemp_artsort}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uniacid', 'number', 'name'], 'required'],
            [['number'], 'integer'],
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
            'name' => '分类名称',
            'number' => '排序'
        ];
    }
}

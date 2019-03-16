<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%sitetemp_article}}".
 */
class SitetempArticle extends \yii\db\ActiveRecord
{
    
    const SCENARIO_EDIT = 'edit';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sitetemp_article}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uniacid' , 'sortid', 'title'], 'required'],
        ];
    }

    //安全属性场景
    public function scenarios()
    {
        return [
            self::SCENARIO_EDIT => ['content', 'title', 'img' , 'number' , 'time' , 'author' , 'sortid'],
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
            'content' => '文章内容',
            'title' => '标题',
            'img' => '封面图片',
            'number' => '排序 越大越前',
            'time' => '时间',
            'readed' => '阅读量',
            'author' => '作者',
            'sortid' => '分类id',
        ];
    }
}

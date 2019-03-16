<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%sitetemp_form}}".
 */
class SitetempCard extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%site_card}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uniacid', 'name'], 'required'],
            [['tel'], 'string', 'max' => 11],
            [['location', 'position', 'wechar', 'mail', 'company', 'address', 'sign', 'content', 'headimg', 'tag'], 'string'],
            [['see', 'reliable', 'share', 'call'], 'integer']
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
            'name' => '姓名',
            'location' => '定位',
            'position' => '位置',
            'see' => '人气',
            'reliable' => '靠谱',
            'share' => '转发',
            'tel' => '手机',
            'wechar' => '微信号',
            'mail' => '邮箱',
            'company' => '公司',
            'address' => '地址',
            'sign' => '签名',
            'call' => '签名点赞数',
            'content' => '内容',
            'headimg' => '头像',
            'tag' => '标签',
        ];
    }
}

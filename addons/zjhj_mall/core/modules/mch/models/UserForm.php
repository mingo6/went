<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/3
 * Time: 13:54
 */

namespace app\modules\mch\models;

/**
 * @property \app\models\User $user
 */
class UserForm extends Model
{
    public $store_id;
    public $user;


    public $level;
    public $parent_id;


    public function rules()
    {
        return [
            [['level', 'parent_id'],'integer']
        ];
    }

    public function attributeLabels()
    {
        return [
            'level'=>'会员等级',
            'parent_id'=>'会员上级id',
        ];
    }

    public function save()
    {
        if(!$this->validate()){
            return $this->getModelError();
        }

        $this->user->level = $this->level;
        $this->user->parent_id = $this->parent_id;

        if($this->user->save()){
            return [
                'code'=>0,
                'msg'=>'成功'
            ];
        }else{
            return $this->getModelError($this->user);
        }
    }
}
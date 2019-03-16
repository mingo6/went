<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/7/25
 * Time: 19:19
 */

namespace app\modules\api\models;


use app\models\User;
use app\models\BalanceLog;
use app\models\Express;
use yii\db\Expression;
use app\models\ChargeGive;

class AddBalanceForm extends Model
{
    public $store_id;
    public $user_id;
    public $user_name;
    public $total_price;
    public $content;
    public $operator;
    public $operator_id;

    public function rules()
    {
        return [
            [['total_price'], 'required'],
        ];
    }

    public function save()
    {
        $user = User::findOne($this->user_id);
        $num=$this->total_price;

        $recharge = ChargeGive::find()->where(['<=','charge_num',$num])->andWhere(['store_id'=> $this->store_id])->orderBy(['charge_num'=>SORT_DESC])->asArray()->one();
        
        $price=$this->total_price + $recharge['send_num'];

        $userRe = $user->updateAll(['balance'=>new Expression('balance+'.$price)],['id'=>$this->user_id]);
        if(!$userRe) {
            return $this->getModelError($user);
        }

        if(empty($user->nickname)) $user->nickname = '会员'.$this->user_id;
        if(empty($this->content)) $this->content = '订单充值';
        if(empty($this->operator)) $this->operator = $user->nickname;
        if(empty($this->operator_id)) $this->operator_id = 0;

        // 添加日志
        $balance = new BalanceLog();
        $balance->store_id = $this->store_id;
        $balance->user_id = $this->user_id;
        $balance->username = $user->nickname;
        $balance->money = $this->total_price;
        $balance->addtime = time();
        $balance->content = $this->content;
        $balance->operator = $this->operator;
        $balance->operator_id = $this->operator_id;

        if ($balance->save()) {
            return [
                'code' => 0,
                'msg' => '充值余额成功',
            ];
        } else {
            return $this->getModelError($balance);
        }
    }
}
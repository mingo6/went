<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/7/25
 * Time: 19:19
 */

namespace app\modules\api\models;


use app\models\User;
use app\models\Level;
use app\models\BuyLog;
use app\models\Order;

class UpLevelForm extends Model
{
    public $store_id;
    public $user_id;
    public $order_id;

    public function rules()
    {
        return [
            [['user_id'], 'required'],
        ];
    }

    public function save()
    {
        $order = Order::findOne($this->order_id);
        
        $buyLog = new BuyLog();
        $buyLog -> store_id = $this->store_id;
        $buyLog -> user_id = $this->user_id;
        $buyLog -> money = $order->pay_price;
        $buyLog -> order_id = $order->id;
        $buyLog -> add_time = time();
        $buyLog ->save();

        $log = BuyLog::find()->where(['user_id'=>$this->user_id])->andWhere(['store_id'=> $this->store_id])->asArray()->all();
        $sum = 0;
        foreach($log as $v){
            $sum += $v['money'];
        }

        $level = Level::find()->where(['<=','money',$sum])->andWhere(['store_id'=> $this->store_id])->orderBy(['level'=>SORT_DESC])->one();

        if($level){
            $user = User::findOne($this->user_id);
            $user -> level = $level->level;
            $user -> save();
        }


    }
}
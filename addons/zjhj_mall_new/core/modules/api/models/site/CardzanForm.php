<?php

/**
 * Created by PhpStorm.
 * User: peize
 * Date: 2017/11/27
 * Time: 9:32
 */

namespace app\modules\api\models\site;

use app\modules\api\models\Model;
use app\components\Helpers;

use app\models\SitetempTemp;
use app\models\SitetempPage;
use app\models\SitetempBar;
use app\models\SitetempArticle;
use app\models\SitetempCard;
use app\models\SitetempCall;
use app\models\User;

class CardzanForm extends Model
{
    public $id;
    public $user_id;
    public $op;
    public $actsort;
    public $page = 0;
    public $acid;
    public $type;


    /**
     * @return array
     * 点赞
     */
    public function zan()
    {

        $id = $this->id;
        $acid = $this->acid;
        $type = $this->type;
        $admin = \Yii::$app->user->identity;
        $isdel = 0;

        $map['call_type'] = $type;
        $map['call_id'] = $id;
        $map['user_id'] = $this->user_id;

        $where['id'] = $id;
        $where['uniacid'] = $acid;
        if (!$id) {
            return [
                'code' => 1,
                'msg' => 'id不能为空！'
            ];
        }
        $card = SitetempCard::findOne($where);
        if (!$card) {
            return [
                'code' => 1,
                'msg' => '名片不存在！'
            ];
        }

        $sitetempCall = SitetempCall::findOne($map);
        if ($sitetempCall) {
            if (!$sitetempCall->delete()) {
                return [
                    'code' => 1,
                    'msg' => '网络错误！'
                ];
            }
            $isdel = 1;
        } else {
            $sitetempCall = new SitetempCall();
            $sitetempCall->uniacid = $acid;
            $sitetempCall->user_id = $this->user_id;
            $sitetempCall->call_id = $id;
            $sitetempCall->addtime = time();
            $sitetempCall->call_type = $type;
            $sitetempCall->save();
        }
        $num = 0;
        if ($type == 1) {
            if ($isdel == 0) {
                $num = ++$card->reliable;
            } else {
                $num = --$card->reliable;
            }
        } elseif ($type == 2) {
            if ($isdel == 0) {
                $num = ++$card->call;
            } else {
                $num = --$card->call;
            }
        }
        if (!$card->save()) {
            return [
                'code' => 1,
                'msg' => '系统错误！'
            ];
        }
        return [
            'code' => 0,
            'msg' => '成功',
            'data' => array(
                'is_del' => $isdel,
                'num' => $num
            )
        ];

    }


    public function lists()
    {

        $page = $this->page;
        $card = SitetempCard::find()
            ->where(['uniacid' => $this->acid])
            ->offset($page)
            ->limit(10)
            ->asArray()
            ->all();

        foreach ($card as $k => $v) {
            $card[$k]['rank'] = ($page * 10) + ($k + 1);
        }

        if ($card) {
            return [
                'code' => 0,
                'msg' => '获取成功',
                'data' => $card
            ];
        } else {
            return [
                'code' => 0,
                'msg' => '查无数据',
            ];
        }

    }

    public function info()
    {
        $where['id'] = $this->id;
        $where['uniacid'] = $this->acid;
        $data = SitetempCard::find()
            ->where($where)
            // ->asArray()
            ->one();
        if (!$data) {
            return [
                'code' => 1,
                'msg' => '查无数据'
            ];
        }
        $data->updateCounters(['see' => 1]);
        $dataInfo = $data->toArray();
        $dataInfo['is_reliable'] = 0;
        $dataInfo['is_call'] = 0;
        $map['call_type'] = 1;
        $map['call_id'] = $this->id;
        $map['user_id'] = $this->user_id;
        $count = SitetempCall::find()->where($map)->count();
        $dataInfo['is_reliable'] = $count > 0 ? 1:0;
        $map['call_type'] = 2;
        $count = SitetempCall::find()->where($map)->count();
        $dataInfo['is_call'] = $count > 0 ? 1:0;
        return [
            'code' => 0,
            'data' => $dataInfo
        ];
    }
    
    /**
     * 转发
     *
     * @return void
     */
    public function transpond(){
        $where['id'] = $this->id;
        $where['uniacid'] = $this->acid;
        if (!$this->id) {
            return [
                'code' => 1,
                'msg' => 'id不能为空！'
            ];
        }
        $card = SitetempCard::findOne($where);
        if (!$card) {
            return [
                'code' => 1,
                'msg' => '名片不存在！'
            ];
        }
        if (!$card->updateCounters(['share' => 1])) {
            return [
                'code' => 1,
                'msg' => '系统错误！'
            ];
        }
        return [
            'code' => 0,
            'msg' => '转发成功！',
            'data' => [
                'num' => $card->share++
            ]
        ];
    }
}
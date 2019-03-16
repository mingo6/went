<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/7/1
 * Time: 16:52
 */

namespace app\modules\api\models;


use app\models\Setting;
use app\models\Share;
use app\models\User;
use app\models\Coupon;
use app\models\UserCoupon;
use app\modules\mch\models\Model;
use Curl\Curl;

class LoginForm extends Model
{
    public $wechat_app;

    public $code;
    public $user_info;
    public $encrypted_data;
    public $iv;
    public $signature;

    public $store_id;

    public function rules()
    {
        return [
            [['wechat_app', 'code', 'user_info', 'encrypted_data', 'iv', 'signature',], 'required'],
        ];
    }

    public function login()
    {
        if (!$this->validate())
            return $this->getModelError();
        $res = $this->getOpenid($this->code);
        //打开调试模式
       // $res['openid'] = 'o_QPT0X-O0bGBkcGFcnx9lQDjhVE';
       // $res['session_key'] = 'o_QPT0X-O0bGBkcGFcnx9lQDjhVE';

        if (!$res || empty($res['openid'])) {
            return [
                'code' => 1,
                'msg' => '获取用户OpenId失败',
                'data' => $res,
            ];
        }
        $session_key = $res['session_key'];
        require __DIR__ . '/wxbdc/WXBizDataCrypt.php';
        $pc = new \WXBizDataCrypt($this->wechat_app->app_id, $session_key);
        $errCode = $pc->decryptData($this->encrypted_data, $this->iv, $data);
        //打开调试模式
       // $errCode = 0;
        if ($errCode == 0) {
            $data = json_decode($data, true);
            $user = User::findOne(['wechat_open_id' => $data['openId'], 'store_id' => $this->store_id]);
            if (!$user) {
                $user = new User();
                $user->type = 1;
                $user->username = $data['openId'];
                $user->password = \Yii::$app->security->generatePasswordHash(\Yii::$app->security->generateRandomString());
                $user->auth_key = \Yii::$app->security->generateRandomString();
                $user->access_token = \Yii::$app->security->generateRandomString();
                $user->addtime = time();
                $user->is_delete = 0;
                $user->wechat_open_id = $data['openId'];
                $user->wechat_union_id = isset($data['unionId']) ? $data['unionId'] : '';
                //$user->nickname = $data['nickName'];
                $user->nickname = preg_replace('/[\xf0-\xf7].{3}/', '', $data['nickName']);
                $user->avatar_url = $data['avatarUrl'];
                $user->store_id = $this->store_id;
                $user->save();
                $same_user = User::find()->select('id')->where([
                    'AND',
                    [
                        'store_id' => $this->store_id,
                        'wechat_open_id' => $data['openId'],
                        'is_delete' => 0,
                    ],
                    ['<', 'id', $user->id],
                ])->one();
                if ($same_user) {
                    $user->delete();
                    $user = null;
                    $user = $same_user;
                }
            }
            $share = Share::findOne(['user_id' => $user->parent_id]);
            $share_user = User::findOne(['id' => $share->user_id]);
            return [
                'code' => 0,
                'msg' => 'success',
                'data' => (object)[
                    'access_token' => $user->access_token,
                    'nickname' => $user->nickname,
                    'avatar_url' => $user->avatar_url,
                    'is_distributor' => $user->is_distributor ? $user->is_distributor : 0,
                    'parent' => $share->id ? ($share->name ? $share->name : $share_user->nickname) : '总店',
                    'id' => $user->id,
                    'is_clerk' => $user->is_clerk,
                    'integral' => $user->integral,
                ],
            ];

        } else {
            return [
                'code' => 1,
                'msg' => '登录失败',
            ];
        }


    }

    //领取优惠券
    public function send($pid,$user_id,$coupon_id)
    {
        $coupon = Coupon::find()->where(['store_id'=>$this->store_id,'is_delete'=>0,'id'=>$coupon_id])->asArray()->one();
        if(!$coupon){
            return [
                'code'=>1,
                'msg'=>'网络异常'
            ];
        }
        $coupon['type'] = 1; //领取的优惠券 ====》改为 发放的优惠券
        $user_coupon = UserCoupon::find()
            ->where(['store_id'=>$this->store_id,'coupon_id'=>$coupon_id,'user_id'=>$user_id,'type'=>1,'is_delete'=>0])->exists();
        if($user_coupon){
            $coupon_list[] = $coupon;
            $form = new CouponListForm();
            $form->store_id = $this->store_id;
            $form->user_id = $user_id;
            $coupon_list_new = $form->getList();
            return [
                'code'=>1,
                'msg'=>'已领取',
                'data'=>[
                    'coupon_list'=>$coupon_list_new
                ]
            ];
        }
        $coupon_count = UserCoupon::find()->where(['store_id'=>$this->store_id,'is_delete'=>0,'coupon_id'=>$coupon_id,'type'=>1])->count();
        if($coupon['total_count'] != -1 && $coupon['total_count'] <= $coupon_count){
            return [
                'code'=>1,
                'msg'=>'优惠券已领完'
            ];
        }
        $res = new UserCoupon();
        $res->id = $user_coupon['id'];
        $res->user_id = $user_id;
        $res->store_id = $this->store_id;
        $res->coupon_id = $coupon_id;
        $res->coupon_auto_send_id = 0;
        $res->type = 1;
        $res->is_use = 0;
        $res->is_expire = 0;
        $res->is_delete = 0;
        $res->addtime = time();
        if ($coupon['expire_type'] == 1) {
            $res->begin_time = time();
            $res->end_time = time() + max(0, 86400 * $coupon['expire_day']);
        } elseif ($coupon['expire_type'] == 2) {
            $res->begin_time = $coupon['begin_time'];
            $res->end_time = $coupon['end_time'];
        }
        $res1 = $res->save();
        if($res1){
            $coupon_list[] = $coupon;
            $form = new CouponListForm();
            $form->store_id = $this->store_id;
            $form->user_id = $user_id;
            $coupon_list_new = $form->getList();
            return [
                'code'=>0,
                'msg'=>'success',
                'data' => [
                    'list' => $coupon_list,
                    'coupon_list'=>$coupon_list_new
                ],
            ];
        }else{
            return [
                'code'=>1,
                'msg'=>'领取优惠券失败'
            ];
        }
    }



    private function getOpenid($code)
    {
        $api = "https://api.weixin.qq.com/sns/jscode2session?appid={$this->wechat_app->app_id}&secret={$this->wechat_app->app_secret}&js_code={$code}&grant_type=authorization_code";
        $curl = new Curl();
        $curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
        $curl->get($api);
        $res = $curl->response;
        $res = json_decode($res, true);
        return $res;
    }
}
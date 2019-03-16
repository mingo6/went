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
use app\models\SitetempAdmin;

class BindadminForm extends Model
{
    public $op;
    public $openid;
    public $scene;
    public $acid;

    public $method = false;


    /**
     * @return array
     * 获取模块
     */
    public function serach()
    {
        
        $op = $this -> op;
        $openid = $this -> openid;
        $scene = $this -> scene;
        $acid = $this -> acid;

        if($method && $op){

            if(!$openid){
                return [
                    'code' => 1,
                    'msg' => '您的会员数据不存在'
                ];
            }

            if(!$scene){
                return [
                    'code' => 1,
                    'msg' => '已过期,请重新扫码'
                ];
            }

            // $scene = Util::getCache('scene','all');
            // if( empty( $scene ) || $scene['time'] < TIMESTAMP ) $this->result(2,'已过期,请重新扫码');
            
            // if( $_GPC['scene'] != $scene['id'] ) $this->result(2,'已过期,请重新扫码');

            $isset = SitetempAdmin::findOne([
                'uniacid' => $uniacid,
                'openid' => $openid
            ]);

            if($isset){
                return [
                    'code' => 1,
                    'msg' => '您已经绑定过了'
                ];
            }


        }

        if(!$op){
            return [
                'code' => 1,
                'msg' => '请先绑定'
            ];
        }elseif($op == 'bind'){
            $admin = new SitetempAdmin();
            $admin -> uniacid = $acid;
            $admin -> openid = $openid;
            $res = $admin -> save();
            if($res){
                return [
                    'code' => 0,
                    'msg' => '绑定成功'
                ];
            }else{
                return [
                    'code' => 1,
                    'msg' => '绑定失败，请扫码重试'
                ];
            }
        }
    




    }



}
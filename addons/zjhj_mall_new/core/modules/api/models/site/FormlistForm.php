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
use app\models\SitetempForm;



class FormlistForm extends Model
{
    public $op;
    public $type;
    public $password;
    public $acid;
    public $id;
    public $page;

    public $data;

    public $ispost = false;

    public $frompass;


    /**
     * @return array
     * 获取模块
     */
    public function serach()
    {

        if(!$this->password){
            return [
                'code' => 1,
                'msg' => '请填写验证码'
            ];
        }

        $key ='module_setting:%s:%s';
        $acid = $this->acid;
        $name = 'zofui_sitetemp';

        $setting = Helpers::getcache($key,$acid,$name);
        $setting['settings'] = unserialize($setting['settings']);

        $this->frompass = $setting['settings']['frompass'];

        if($this->password != $this-> frompass){
            return [
                'code' => 1,
                'msg' => '验证码不正确'
            ];
        }

        if($this-> op == 'list' ){
            $where['uniacid'] = $this -> acid;

            if($this->type == 1 ){
                $where['isread'] = 0;
            }elseif($this->type ==2 ){
                $where['isread'] = 1;
            }

            $info = SitetempForm::find()
            ->where($where)
            ->limit(10)
            ->orderBy(['id' => SORT_DESC])
            ->asArray()
            ->all();



            $list = $info;


            if($list){
                foreach ($list as &$v) {
                    $v['data'] = Helpers::iunserializer( $v['data'] );
                    $v['createtime'] = date('Y-m-d H:i:s',$v['createtime']);
                }
            }

            return [
                'code' => 0,
                'msg' => '获取数据成功',
                'data' => $list
            ];

        }elseif($this->op == 'readit'){

            $form = SitetempForm::findOne(['uniacid' => $this->acid,'id' => $this->id]);
            $form -> isread = 1;
            $form -> save();

            return [
                'code' => 1,
                'msg' => '查看文章'
            ];


        }


        
        

    }




    public function submit(){

        
        if( $this->ispost ) {

            $content = htmlspecialchars_decode( $this->data );

            $data = json_decode( $content,true );

            if(!$data){
                return [
                    'code' => 1,
                    'msg' => '请提交数据'
                ];
            } 

            /*foreach ( $data as $k => $v ) {
                if( empty( $v ) ) $this->result(1,'请填写'.$k);
            }*/

            $form = new SitetempForm();
            $form -> uniacid = $this->acid;
            $form -> data = $data;
            $form -> createtime = time();
            $res = $form -> save();

            if($res){

                if($this-> module['config']['mail']){

                    $body = array('有人提交了一项表单数据，请查收');
                    if($data){
                        foreach($data as $k => $v){
                            if(is_array($v)){
                                $in = "";
                                foreach($v as $vv){
                                    $in .= $vv.'，';
                                }
                                $in = trim($in,'，');
                                $item = $k.'：'.$in;
                            }else{
                                $item = $k.'：'.$v;
                            }
                            $body[] = $item;
                        }
                    }

                    //Util::ihttp_email($this->module['config']['mail'], '表单通知', $body);

                }

                return [
                    'code' => 0,
                    'msg' => '已提交'
                ];

            }



            
        }

        return [
            'code' => 1,
            'msg' => '提交失败'
        ];

    }
















}
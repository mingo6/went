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

class ArticleForm extends Model
{
    public $id;
    public $op;
    public $actsort;
    public $page;
    public $acid;


    /**
     * @return array
     * 获取模块
     */
    public function serach()
    {

        $op = $this->op;
        $acid = $this-> acid;
        if($op == 'list'){
            
            $where['uniacid'] = $acid;
            $actsort = $this->actsort;
            if($actsort){
                $where['sortid'] = $actsort;
            }

            $page = $this-> page ? $this->page: 1;
            $info = SitetempArticle::find()->where($where)
            ->offset($page)
            ->limit(10)
            ->orderBy(['number' => SORT_DESC])
            ->asArray()
            ->all();

            $list = $info[0];

            if($list){
                foreach($list as &$v){
                    $v['url'] = '/zjhj_mall/pages/art/art?aid='.$v['id'];
                    $v['img'] = tomedia($v['img']);
                }
            }

            $data['art'] = $list;


            // 页脚导航

            $where = array();
            $where['uniacid'] = $acid;
            $where['isact'] = 1;

            $temp = SitetempTemp::findOne($where);
            if($temp){
                $bar = SitetempBar::findOne([
                    'uniacid' => $acid,
                    'tempid' => $temp['id']
                ]);
                if($bar){
                    $bar['data'] = Helpers::iunserializer($bar['data']);
                }
            }

            $data['bar'] = $bar;

            return [
                'code' => 0,
                'msg' => '获取数据成功',
                'data' => $data
            ];

        }elseif($op == 'article'){

            $id = 1;

            $info = SitetempArticle::find()
            ->where([
                'uniacid' => $acid,
                'id' => $id,
            ])->asArray()->limit(1)->one();
            
            $info2 = SitetempArticle::find()
            ->where([
                'uniacid' => $acid,
                'id' => $id,
            ])->limit(1)->one();
            $info2 -> readed += 1;
            $info2 -> save();

            return [
                'code' => 0,
                'msg' => '获取数据成功',
                'data' => $info
            ];

            

        }



    }

}
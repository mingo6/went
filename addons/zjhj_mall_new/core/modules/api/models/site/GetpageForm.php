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
use app\models\Store;

class GetpageForm extends Model
{
    public $pid;
    public $acid;
    public $store_id;
    /**
     * @return array
     * 获取模块
     */
    public function getPage()
    {

        $pid = $this->pid;

        $where['uniacid'] = $this->acid;

        if ($pid) {
            $where['id'] = $pid;
        } else {

            $map['isact'] = 1;
            $map['uniacid'] = $this->acid;
            $temp = SitetempTemp::findOne($map);
            if ($temp) {
                $whe['uniacid'] = $this->acid;
                $whe['tempid'] = $temp->id;
                $bar = SitetempBar::findOne($whe);
                if ($bar) {
                    $bar['data'] = Helpers::iunserializer($bar['data']);
                    $id = intval($bar['data']['data'][0]['pageid']);
                    if ($id > 0) {
                        $where['id'] = $id;
                    }
                }
            }

        }

        $page = SitetempPage::find()->where($where)->asArray()->limit(1)->one();
        $page['params'] = Helpers::iunserializer($page['params']);

        if (!empty($page['params']['data'])) {

            foreach ($page['params']['data'] as &$v) {
                if ($v['name'] == 'text') {
                    $v['params']['content'] = urldecode($v['params']['content']);
                }

                $article = array();
                if ($v['name'] == 'article') {

                    $where = array();
                    $where['uniacid'] = $this->acid;
                    $where['sortid'] = $v['params']['sortid'];

                    $info = SitetempArticle::find()->where($where)
                        ->offset(1)->limit(3)->orderBy(['number' => SORT_DESC])
                        ->asArray()->all();

                    if (!empty($info[0])) {
                        $v['artlist'] = array();
                        foreach ($info[0] as &$vv) {
                            $art = array();
                            $art['title'] = $vv['title'];
                            $art['img'] = tomedia($vv['img']);
                            $art['url'] = '/zjhj_mall/pages/art/art?aid=' . $vv['id'];
                            $art['time'] = $vv['time'];
                            $v['artlist'][] = $art;
                        }
                        unset($vv);
                    }
                }

            }
        }



        $data['page'] = $page;

        if (!$bar) {

            $temp = SitetempTemp::find()->where([
                'uniacid' => $this->acid,
                'isact' => 1
            ])->asArray()->one();

            if (!empty($temp['id'])) {

                $bar = SitetempBar::find()->where([
                    'uniacid' => $this->acid,
                    'tempid' => $temp['id']
                ])->asArray()->one();

                if (!empty($bar)) {
                    $bar['data'] = Helpers::iunserializer($bar['data']);
                }
            }
        }
        if(!empty($bar['data']['data'])){
            if(is_object($bar)){
                $bar = $bar->toArray();
            }
            foreach($bar['data']['data'] AS $key => &$value){
                if(!preg_match('/^https?:\/\//i', $value['img'])){
                    $value['img'] = \Yii::$app->urlManager->hostInfo . $value['img'];
                }
                if(!preg_match('/^https?:\/\//i', $value['actimg'])){
                    $value['actimg'] = \Yii::$app->urlManager->hostInfo . $value['actimg'];
                }
            }
        }
        // copyright
        $data['bar'] = $bar['data'];
        $store = Store::findOne($this->store_id);
        if (!empty($store) && !empty($store['copyright'])) {
            $data['copy'] = htmlspecialchars_decode($store['copyright']);
            $data['copyright_url'] = htmlspecialchars_decode($store['copyright_url']);
            $data['copyright_pic_url'] = htmlspecialchars_decode($store['copyright_pic_url']);
        }
        return [
            'code' => 0,
            'msg' => '获取数据成功',
            'data' => $data,
        ];

    }

}
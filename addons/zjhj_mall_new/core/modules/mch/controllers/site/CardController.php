<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/12/5
 * Time: 15:24
 */

namespace app\modules\mch\controllers\site;

use app\models\SitetempArticle;
use app\models\SitetempArtsort;
use app\models\SitetempCard;


class CardController extends Controller
{
    //参数设置
    public function actionIndex()
    {   
        $acid = $this-> store -> acid;
        $list = SitetempCard::find()
        ->where(['uniacid' => $acid])
        ->asArray()
        ->orderBy(['id' => SORT_DESC])
        ->all();

        $count = count($list);
        return $this->render('index',[
            'list' => $list,
            'pagination' => $count,
        ]);
        
    }

    public function actionEdit(){
        $id = \Yii::$app->request->get('id');
        if($id){
            $card = SitetempCard::findOne($id);
            if(!empty($card)) $card = $card->toArray();
        }

        return $this->render('edit',[
            'card' => $card,
        ]);
    }


    //保存名片
    public function actionAddcard(){

        $model = \Yii::$app->request->post('data');
        $id = \Yii::$app->request->post('id');
        $acid = $this-> store->acid;
        if($id){
            $card = SitetempCard::findOne([
                'id' => $id,
                'uniacid' => $acid
            ]);
        }else{
            $card = new SitetempCard();
            $model['uniacid'] = $acid;
        }
        
        $card -> attributes = $model;

        if(!$card->validate()) {
            $return = [
                'code' => 1,
                'msg' => implode('',$card->getFirstErrors())
            ];
            $this->renderJson($return);
        }

        if($card -> save() !== false) {
            $return = [
                'code' => 0,
                'msg' => '操作成功'
            ];
            $this->renderJson($return);
        }

        $return = [
            'code' => 1,
            'msg' => '操作失败'
        ];
        $this->renderJson($return);


    }


    //删除名片
    public function actionDelcard(){
        $id = \Yii::$app->request->get('id');
        $acid = $this-> store->acid;
        $card = SitetempCard::findOne([
            'id' => $id,
            'uniacid' => $acid
        ]);
        $res = $card -> delete();

        $this->redirect(array('site/card/index'));

    }



}
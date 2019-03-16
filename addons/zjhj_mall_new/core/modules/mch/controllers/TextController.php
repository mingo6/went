<?php

namespace app\modules\mch\controllers;

use app\hejiang\CloudPlugin;
use yii\helpers\VarDumper;
use app\models\SitetempTemp;
use app\models\SitetempBar;
use app\models\Store;
use app\models\SitetempPage;
use app\models\SitetempArtsort;
use app\models\SitetempArticle;

//企业文章
class TextController extends Controller
{
    
    public function actionList(){

        //$admin = \Yii::$app->user->identity; 

        $artsort = SitetempArtsort::find()->where(['uniacid' => $this->store->acid])->asArray()->orderBy(['member' => SORT_DESC])->all();
        
        return $this->render('index', [
            'artsort' => $artsort
        ]);

    }


    //添加/保存文章分类
    public function actionAddtext(){

        $fid = \Yii::$app->request->post('fid');
        if($fid > 0){
            $form = SitetempArtsort::findOne(['uniacid' => $this->store->acid);
            if(!$form){
                return [
                    'code' => 1,
                    'msg' => '没有找到数据'
                ];
            }
        }

        $name =\Yii::$app->request->post('name');
        $uniacid = $this->store->acid;
        $number =\Yii::$app->request->post('number');

        if(empty($name)){
            return [
                'code' => 1,
                'msg' => '请填写名称'
            ];
        }

        if($fid > 0){
            $form -> number = $number;
            $form -> uniacid = $uniacid;
            $form -> name = $name;
            $res = $form -> save();
        }else{
            $artsort = new SitetempArtsort();
            $artsort -> number =$number;
            $artsort -> uniacid =$uniacid;
            $artsort -> name =$name;
            $res = $artsort -> save();
        }

        if($res){
            return [
                'code' => 0,
                'msg' => '已保存'
            ];
        }

        return [
            'code' => 1,
            'msg' => '保存失败'
        ];


    }



    //删除文章分类
    public function actionDelete(){
        $id = \Yii::$app->request->get('id');
        $res = SitetempArtsort::delete(['id' => $id]);
        if($res){
            return [
                'code' => 0,
                'msg' => '删除成功'
            ];
        }else{
            return [
                'code' => 1,
                'msg' => '删除失败'
            ];
        }
    }

    //删除所有文章分类
    public function actionDeleteall(){

        $id = \Yii::$app->request->get('id');
        $res = SitetempArtsort::deleteAll([
            'in' , 'id' , $id
            ]);
        if($res){
            return [
                'code' => 0,
                'msg' => '删除成功'
            ];
        }else{
            return [
                'code' => 1,
                'msg' => '删除失败'
            ];
        }
    }


    //添加/编辑文章
    public function actionSave(){

		$number = \Yii::$app->request->post('number');
		$uniacid = $this->store->acid;
		$title = \Yii::$app->request->post('title');
		$content = \Yii::$app->request->post('content');
		$img = \Yii::$app->request->post('img');
		$time = time();
		$author = \Yii::$app->request->post('author');
        $sortid = \Yii::$app->request->post('sortid');

        $id = \Yii::$app->request->post('id');

        if($id){
            $SitetempArticle = SitetempArticle::findOne($id);
            $SitetempArticle -> number = $number;
            $SitetempArticle -> title = $title;
            $SitetempArticle -> content = $content;
            $SitetempArticle -> img = $img;
            $SitetempArticle -> time = $time;
            $SitetempArticle -> author = $author;
            $SitetempArticle -> sortid = $sortid;
            $res = $SitetempArticle -> save();
        }else{
            $SitetempArticle = new SitetempArticle();
            $SitetempArticle -> number = $number;
            $SitetempArticle -> title = $title;
            $SitetempArticle -> content = $content;
            $SitetempArticle -> img = $img;
            $SitetempArticle -> time = $time;
            $SitetempArticle -> author = $author;
            $SitetempArticle -> sortid = $sortid;
            $res = $SitetempArticle -> save();
        }

        if($res){
            return [
                'code' => 0,
                'msg' => '已保存'
            ];
        }else{
            return [
                'code' => 1,
                'msg' => '保存失败'
            ];
        }
        
    }





    //删除文章
    public function actiondelarticle(){

        $id = \Yii::$app->request->get('id');
        $res = SitetempArticle::delete($id);

        if($res){
            return [
                'code' => 0,
                'msg' => '已删除'
            ];
        }else{
            return [
                'code' => 1,
                'msg' => '删除失败'
            ];
        }
        
    }
    


    //删除所有文章
    public function actiondelAll(){

        $id = \Yii::$app->request->get('id');
        $res = SitetempArticle::delete([
            'in' , 'id' , $id
        ]);

        if($res){
            return [
                'code' => 0,
                'msg' => '已删除'
            ];
        }else{
            return [
                'code' => 1,
                'msg' => '删除失败'
            ];
        }
        
    }






}
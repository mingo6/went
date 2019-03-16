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


class ArticleController extends Controller
{
    //文章列表
    public function actionIndex()
    {   
        $where['uniacid'] = $this-> store -> acid;
        $article = SitetempArticle::find()
        ->where($where)
        ->orderBy(['number' => SORT_DESC])
        ->asArray()
        ->all();

        $count = count($article);
        return $this->render('index',[
            'article' => $article,
            'pagination' => $count,
        ]);
        
    }

    //添加、编辑文章预览
    public function actionEdit(){

        $id = \Yii::$app->request->get('id');
        if($id){
            $article = SitetempArticle::findOne($id);
        }

        $sort = SitetempArtsort::find()
        ->where(['uniacid' => $this->store->acid])
        ->asArray()
        ->all();

        return $this->render('edit',[
            'article' => $article,
            'sort' => $sort
        ]);
    }

    //添加、编辑文章
    public function actionEditart(){

        $id = \Yii::$app->request->post('id');
        
        $model = \Yii::$app->request->post('model');

        if($id){
            $article = new SitetempArticle();
            $article = $article->findOne($id);
            $article -> scenario  = 'edit';
            // $article = SitetempArticle::findOne($id);
        }else{
            $article = new SitetempArticle();
            $article -> scenario  = 'edit';
        }
        
        $article -> attributes = $model;
        $article -> time = strtotime($model['time']);
        $article -> uniacid = $this->store->acid;

        if(!$article->validate()) {
            $return = [
                'code' => 1,
                'msg' => implode('',$article->getFirstErrors())
            ];
            $this->renderJson($return);
        }

        if($article -> save()){
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


    //删除文章
    public function actionDelarticle(){

        
        $id = \Yii::$app->request->get('id');

        if(is_array($id)){
            $res = SitetempArticle::deleteAll(['in','id',$id]);
        }else{
            $SitetempArticle = SitetempArticle::findOne($id);
            $res = $SitetempArticle -> delete();
        }
        
        $this->redirect(array('site/article/index'));

    }


    //分类列表
    public function actionArtsort(){

        $where['uniacid'] = $this-> store -> acid;
        $artsort = SitetempArtsort::find()
        ->where($where)
        ->orderBy(['number' => SORT_DESC])
        ->asArray()
        ->all();

        $count = count($artsort);
        return $this->render('artsort',[
            'artsort' => $artsort,
            'pagination' => $count,
        ]);   


    }


    //添加、编辑分类预览
    public function actionSortedit(){

        $id = \Yii::$app->request->get('id');
        if($id){
            $article = SitetempArtsort::findOne($id);
        }

        return $this->render('sortedit',[
            'article' => $article
        ]);

    }



    //添加、编辑分类
    public function actionEditsort(){

        $id = \Yii::$app->request->post('id');
        
        $model = \Yii::$app->request->post('model');

        if($id){
            $article = SitetempArtsort::findOne($id);
        }else{
            $article = new SitetempArtsort();
        }
        
        $article -> number = $model['number'];
        $article -> name = $model['name'];
        $article -> uniacid = $this->store->acid;

        if(!$article->validate()) {
            $return = [
                'code' => 1,
                'msg' => implode('',$article->getFirstErrors())
            ];
            $this->renderJson($return);
        }

        if($article -> save()){
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










    //删除分类
    public function actionDelartsort(){
         
        $id = \Yii::$app->request->get('id');
        //echo $id;die;
        if(is_array($id)){
            $res = SitetempArtsort::deleteAll(['in','id',$id]);
        }else{
            $SitetempArtsort = SitetempArtsort::findOne($id);
            $res = $SitetempArtsort -> delete();
        }
        
        $this->redirect(array('site/article/artsort'));
    }



}
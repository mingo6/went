<?php
/**
 * Created by PhpStorm.
 * User: peize
 * Date: 2017/11/24
 * Time: 16:41
 */

namespace app\modules\api\controllers\site;

use app\modules\api\models\site\FormlistForm;


/**
 * Class IndexController
 * @package 
 * 官网模块
 */
class FormController extends Controller
{
    /**
     * @return mixed|string
     * 获取模板
     */
    public function actionIndex()
    {
        
        $form = new FormlistForm();
        $form -> op = \Yii::$app->request->get('op');
        $form -> password = \Yii::$app->request->get('password');
        $form -> type = \Yii::$app->request->get('type');
        $form -> id = \Yii::$app->request->get('id');
        $form -> page = \Yii::$app->request->get('page');
        $form -> acid = $this-> store -> acid;

        $this->renderJson($form->serach());
        
    }


    public function actionSaveform(){

        $form = new FormlistForm();
        $form -> data = \Yii::$app->request->post('data');

        $this->renderJson($form->submit());

    }



}
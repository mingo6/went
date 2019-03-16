<?php
/**
 * Created by PhpStorm.
 * User: peize
 * Date: 2017/11/24
 * Time: 16:41
 */

namespace app\modules\api\controllers\site;

use app\modules\api\models\site\BindadminForm;



/**
 * Class IndexController
 * @package 
 * 官网模块
 */
class BindadminController extends Controller
{
    /**
     * @return mixed|string
     * 获取模板
     */
    public function actionIndex()
    {
        $form = new BindadminForm();
        $form -> op = \Yii::$app->request->get('op');
        $form -> openid = \Yii::$app->request->get('openid');
        $form -> scene = \Yii::$app->request->get('scene');
        $form -> acid = $this-> store -> acid;
        $this->renderJson($form->serach());
        
    }



}
<?php
/**
 * Created by PhpStorm.
 * User: peize
 * Date: 2017/11/24
 * Time: 16:41
 */

namespace app\modules\api\controllers\site;

use app\models\SitetempTemp;
use app\models\SitetempPage;
use app\models\SitetempBar;
use app\models\SitetempArticle;
use app\components\Helpers;
use app\modules\api\models\site\ArticleForm;


/**
 * Class IndexController
 * @package app\modules\api\controller\group
 * 官网模块
 */
class ArticleController extends Controller
{
    /**
     * @return mixed|string
     * 获取模板
     */
    public function actionIndex()
    {
        
        $form = new ArticleForm();
        $form -> op = \Yii::$app->request->post('op');
        $form -> actsort = \Yii::$app->request->post('actsort');
        $form -> page = \Yii::$app->request->post('page');
        $form -> id = \Yii::$app->request->post('id');
        $form -> acid = $this->store->acid;
        $this->renderJson($form->serach());

    }



}
<?php

/**
 * Created by PhpStorm.
 * User: peize
 * Date: 2017/11/24
 * Time: 16:41
 */

namespace app\modules\api\controllers\site;

use app\modules\api\models\site\GetpageForm;

/**
 * Class IndexController
 * @package app\modules\api\controller\group
 * 官网模块
 */
class IndexController extends Controller
{
    /**
     * @return mixed|string
     * 获取模板
     */
    public function actionIndex()
    {
        $form = new GetpageForm();
        $form->pid = \Yii::$app->request->get('pid');
        $form->acid = $this->store->acid;
        $form->store_id = $this->store->id;
        $this->renderJson($form->getPage());
    }
}
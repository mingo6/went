<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/6/24
 * Time: 22:31
 */

namespace app\modules\api\controllers;


use app\models\User;
use app\modules\api\models\LoginForm;

class PassportController extends Controller
{
    public function actionLogin()
    {
        $form = new LoginForm();
        $form->attributes = \Yii::$app->request->post();
        $form->wechat_app = $this->wechat_app;
        $form->store_id = $this->store->id;
        return $this->renderJson($form->login());
    }

    /**
     * 检测是否登录
     *
     * @return void
     */
    public function actionCheckLogin()
    {
        $access_token = \Yii::$app->request->get('access_token');
        if (!$access_token) {
            $access_token = \Yii::$app->request->post('access_token');
        }
        if (!$access_token) {
            return $this->renderJson([
                'code' => -1,
                'msg' => 'access_token 不能为空',
            ]);
        }
        if (\Yii::$app->user->loginByAccessToken($access_token))
            return $this->renderJson([
                'code' => 0,
                'msg' => '已登录',
            ]);
        else
            return $this->renderJson([
                'code' => -1,
                'msg' => '未登录',
            ]);
        
    }
}
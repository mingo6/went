<?php
/**
 * Created by PhpStorm.
 * User: peize
 * Date: 2017/11/24
 * Time: 16:41
 */

namespace app\modules\api\controllers\site;

use app\modules\api\behaviors\LoginBehavior;


use app\modules\api\models\site\GetpageForm;
use app\modules\api\models\site\CardzanForm;
use app\models\SitetempCard;
use app\modules\api\models\BindForm;

/**
 * Class IndexController
 * @package app\modules\api\controller\group
 * 名片
 */
class CardController extends Controller
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'login' => [
                'class' => LoginBehavior::className(),
            ],
        ]);
    }

    /**
     * @return mixed|string
     * 点赞
     */
    public function actionZan()
    {
        $card = new CardzanForm();
        $card -> user_id = \Yii::$app->user->id;
        $card -> id = \Yii::$app->request->post('id');
        $card -> acid = $this-> store -> acid;
        $card -> type = \Yii::$app->request->post('type');
        $this->renderJson($card->zan());
    }

    /**
     * 转发
     *
     * @return void
     */
    public function actionTranspond(){
        $card = new CardzanForm();
        $card->user_id = \Yii::$app->user->id;
        $card->id = \Yii::$app->request->post('id');
        $card->acid = $this->store->acid;
        $this->renderJson($card->transpond());
    }



    public function actionGetinfo(){

        $card = new CardzanForm();
        $card -> user_id = \Yii::$app->user->id;
        $card -> id = \Yii::$app->request->get('id');
        $card -> acid = $this-> store -> acid;

        $this->renderJson($card->info());
        
    }


    public function actionCardlist(){
        $card = new CardzanForm();
        $card -> user_id = \Yii::$app->user->id;
        $card -> acid = $this-> store -> acid;
        
        $this->renderJson($card->lists());
    }



    public function actionRelation(){

        $card_id = \Yii::$app->request->get('id');
        $pid = \Yii::$app->request->get('pid');
        $card = SitetempCard::findOne($card_id);
        if(empty($card)){
            return [
                'code' => 1,
                'msg' => '名片不存在',
            ];
        }

        $BindForm = new BindForm(); 
        $BindForm -> parent_id = $pid;
        $BindForm -> user_id = \Yii::$app->user->id;
        $BindForm -> store_id = $this-> store -> acid;
        $this->renderJson($BindForm->save());

    }




}
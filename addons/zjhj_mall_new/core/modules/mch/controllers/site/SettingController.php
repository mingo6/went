<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/12/5
 * Time: 15:24
 */

namespace app\modules\mch\controllers\site;


use app\models\YySetting;
use app\modules\mch\models\site\SitetemplistForm;
use app\models\SitetempTemp;
use app\models\Store;
use yii\helpers\Url;
use app\components\Helpers;
use app\models\Level;

class SettingController extends Controller
{
    //参数设置
    public function actionIndex()
    {
        if($_POST) {
            $post = self::trimWithArray($_POST);
            
			$dat = array(
				'frompass' => $post['frompass'],
				'mail' => $post['mail'],
            );

			if ($this->saveSettings($dat) !== false) {
                $return =  [
                    'code' => 0,
                    'msg' => '成功'
                ];
                $this->renderJson($return);
            }

            $return =  [
                'code' => 1,
                'msg' => '失败'
            ];
            $this->renderJson($return);
        }
        $modules = Helpers::getcache('zfst', WE7_MODULE_NAME, $this->store->acid);
        $setting = unserialize($modules['settings']);

        return $this->render('index', [
            'setting' => $setting,
            'delcache' => Url::toRoute(['delcache'])
        ]);
        
    }


    //清空缓存
    public function actionDelcache(){
        Helpers::cache_delete();
        $return =  [
            'code' => 0,
            'msg' => '清除成功'
        ];
        $this->renderJson($return);
    }


    //模板
    public function actionMyModel(){
        
        $admin = \Yii::$app->user->identity; 


        $SitetemplistForm = new SitetemplistForm();
        $SitetemplistForm -> uniacid = $this->store->acid;
        $SitetemplistForm -> user_id = $admin->id;
        $SitetemplistForm -> serach();

        $level_list = Level::find()->where(['store_id'=>$this->store->id,'is_delete'=>0,'status'=>1])
            ->orderBy(['level'=>SORT_ASC])->asArray()->all();
        return $this->render('mymoduel', [
            'modules' => $modules
        ]);
        
    }

    public function saveSettings($settings)
    {
        $pars = array('module' => WE7_MODULE_NAME, 'uniacid' => $this->store->acid);
		$row = array();
        $row['settings'] = serialize($settings);
        
        $sql = "SELECT module FROM ims_uni_account_modules WHERE ( `module` = '".WE7_MODULE_NAME."' AND `uniacid` = '".$this->store->acid."')";
        $cachedata = \Yii::$app->db->createCommand($sql)->queryOne();

		if ($cachedata) {
            // $update_sql = "UPDATE ims_uni_account_modules SET settings='{$row[settings]}' WHERE ( `module` = '".WE7_MODULE_NAME."' AND `uniacid` = '".$this->store->acid."')";
            // $res = \Yii::$app->db->createCommand($update_sql)->execute();

            $res = \Yii::$app->db->createCommand()->update('ims_uni_account_modules', [
                'settings' => $row['settings']
            ], "module = '".WE7_MODULE_NAME."' AND uniacid = '".$this->store->acid."'")->execute();

		} else {

            $res = \Yii::$app->db->createCommand()->insert('ims_uni_account_modules', [
                'settings' => $row['settings'],
                'module' => WE7_MODULE_NAME,
                'uniacid' => $this->store->acid,
                'enabled' => 1,
                'shortcut' => 0,
                'displayorder' => 0
            ])->execute();
        }
        
        return $res;
    }


    //处理空格
	static public function trimWithArray($array){
		if(!is_array($array)){
			return trim($array);
		}
		foreach($array as $k=>$v){	
			$res[$k] = self::trimWithArray($v);
		}
		return $res;
	}

    /**
     * 使用说明
     */
    public function actionExplain()
    {
        return $this->render('explain');
    }

}
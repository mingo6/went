<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/8/3
 * Time: 14:36
 * Version: 1.5.2
 */

namespace app\modules\mch\controllers;


use Comodojo\Zip\Zip;
use Curl\Curl;
use yii\helpers\VarDumper;

class UpdateController extends Controller
{
   
    public function actionIndex()
    {
         return $this->render('index', [
                'version' => $this->version,
                'res' => $res,
                'version_list' => [],
            ]);
    }

   

    private function getSiteData()
    {
       
        return $data;
    }

    private function mkdir($dir)
    {
        if (!is_dir($dir)) {
            if (!$this->mkdir(dirname($dir))) {
                return false;
            }
            if (!mkdir($dir)) {
                return false;
            }
        }
        return true;
    }

}
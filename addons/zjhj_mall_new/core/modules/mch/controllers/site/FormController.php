<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/12/5
 * Time: 15:24
 */

namespace app\modules\mch\controllers\site;
use app\models\SitetempForm;

class FormController extends Controller
{
    
    //表单数据
    public function actionIndex(){

		

        $where['isread'] = 0;
		$read = \Yii::$app->request->get('read');

        if($read == 2){
            $where['isread'] = 1;
        }

        $num = 10;
		$page = \Yii::$app->request->get('page');
		$down = \Yii::$app->request->get('down');
		if($down == 1){
			$num = 99999;
			$page = 1;
			$start = strtotime(\Yii::$app->request->get('start'));
			$end = strtotime(\Yii::$app->request->get('end'));
		}

		$list = SitetempForm::find()
		->where($where)
		->andFilterWhere(['between','createtime',$start, $end])
		->offset($page)
		->limit($num)
		->asArray()
		->all();
		

		if( !empty( $list ) ) {
			foreach ( $list as &$v ) {
				$v['data'] = unserialize( $v['data'] );
				$v['content'] = '';
				foreach ((array)$v['data'] as $kk => $vv) {
					if( is_string( $vv ) ) {
						$v['content'] .= $kk.'：'.$vv.'，';
					}elseif( is_array( $vv ) ) {
						$instr = '';
						foreach ($vv as $vvv) {
							$instr .= $vvv.'-';
						}
						$instr = trim( $instr,'-' );
						$v['content'] .= $kk.'：'.$instr.'，';
					}
					
				}
			}
        }

		$count =count($list);

		return $this-> render('index',[
			'list' => $list,
			'pagination' => $count,
			'read' => $read
		]);

        
    }




    public function downLoadOrder(){

        /* 输入到CSV文件 */
		$html = "\xEF\xBB\xBF".$html; //添加BOM
		/* 输出表头 */		
		$html .= '数据id' . "\t,";
		$html .= '数据内容' . "\t,";		
		$html .= '提交时间' . "\t,";
		$html .= "\n";
			
 		foreach((array)$list as $k => $v){	

 			$time = date('Y-m-d H:i:s',$v['createtime']);

 			$data = iunserializer( $v['data'] );
			$content = '';
			foreach ($data as $kk => $vv) {
				if( is_string( $vv ) ) {
					$content .= $kk.'：'.$vv."，";
				}elseif( is_array( $vv ) ) {
					$instr = '';
					foreach ($vv as $vvv) {
						$instr .= $vvv.'-';
					}
					$instr = trim( $instr,'-' );
					$content .= $kk.'：'.$instr."，";
				}
			}
 			
			$html .= $v['id'] . "\t,";
			$html .= $content . "\t,";					
			$html .= $time . "\t,";
			
			$html .= "\n"; 
			
		}
		/* 输出CSV文件 */
		header("Content-type:text/csv");
		header("Content-Disposition:attachment; filename=表单数据.csv");
		echo $html;
        exit;
        
    }


    
	//标记为已审核
	public function actionToreaded(){
		
		$id = \Yii::$app->request->get('id');

		$form = SitetempForm::findOne($id);
		$form -> isread = 1;
		$form -> save();
		//echo 1;die;
		
		$this->redirect(array('site/form/index','read' => 1));

	}



	//删除表单数据
	public function actionDelform(){

		$id = \Yii::$app->request->get('id');
		if(is_array($id)){
			$res = SitetempForm::delete([
				'in','id',$id
			]);
		}else{
			$res = SitetempForm::findOne($id)->delete();
		}
		

		$this->redirect(array('site/form/index','read' => 1));


	}





	public function actionSee(){
		
		return $this->render('see');

	}






}
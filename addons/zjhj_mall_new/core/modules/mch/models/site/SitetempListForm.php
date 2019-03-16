<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/22
 * Time: 17:06
 */

namespace app\modules\mch\models\site;

use app\models\SitetempTemp;
use app\modules\mch\models\Model;

class SitetempListForm extends Model
{
    public $store_id;
    public $user_id;
    public $uniacid;

    private $createtime;
    private $name;
    private $number;
    private $img;
    private $isact;
    private $issystem;
	private $issetsystem;

	const IS_SYSTEM = 1;	//是系统模板
	const NOT_SYSTEM = 0;	//不是系统模板

	const IS_ACT = 1;		//正在使用中
	const NOT_ACT = 0;		//没有使用

    public function rules()
    {
        return [
            [['uniacid', 'createtime', 'number','isact'], 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'uniacid'=>'公众号ID',
            'createtime'=>'创建时间',
            'name'=>'备注名称',
            'number'=>'排序 越大越前',
            'img'=>'图标',
            'isact'=>'0未使用 1使用中',
            'issystem'=>'是否系统模板 0不是 1是 系统模板不能删除修改',
            'issetsystem'=>'是否平台自己设置的系统模板 0不是 1是的',
        ];
    }

    public function serach()
    {   
        $where['uniacid'] = $this -> uniacid;
        $where['issystem'] = 0;

        $order['isact'] = SORT_DESC;
        $order['issystem'] = SORT_ASC;
        $order['number'] = SORT_DESC;

        $module = SitetempTemp::find()->where($where)->orderBy($order)->asArray()->all();

        return [
            'module' => $module
        ];
        
        
    }

    public function sysmodule(){
		$where['issystem'] = 1;

        $order['isact'] = SORT_DESC;
        $order['issystem'] = SORT_ASC;
        $order['number'] = SORT_DESC;

        $module = SitetempTemp::find()->where($where)->orderBy($order)->asArray()->all();
        
        return [
            'module' => $module
        ];
    }


    //单图上传
 	public function tpl_form_field_image($name, $value = '', $default = '', $options = array()) {
		global $_W;
		if (empty($default)) {
			$default = '';
		}
		$val = $default;
		if (!empty($value)) {
			$val = tomedia($value);
			$isshow = '';
		}else{
			$isshow = 'display:none;';
		}
		if (!empty($options['global'])) {
			$options['global'] = true;
		} else {
			$options['global'] = false;
		}
		if (empty($options['class_extra'])) {
			$options['class_extra'] = '';
		}
		if (isset($options['dest_dir']) && !empty($options['dest_dir'])) {
			if (!preg_match('/^\w+([\/]\w+)?$/i', $options['dest_dir'])) {
				exit('图片上传目录错误,只能指定最多两级目录,如: "deobao_store","deobao_store/d1"');
			}
		}
		$options['direct'] = true;
		$options['multiple'] = false;
		if (isset($options['thumb'])) {
			$options['thumb'] = !empty($options['thumb']);
		}
		$s = '';
		if (!defined('TPL_INIT_IMAGE')) {
			$s = '
			<script type="text/javascript">
				function showImageDialog(elm, opts, options) {
					require(["util"], function(util){
						var btn = $(elm);
						var ipt = btn.parent().prev();
						var val = ipt.val();
						var img = ipt.parent().next().children();
						options = '.str_replace('"', '\'', json_encode($options)).';
						util.image(val, function(url){
							if(url.url){
								if(img.length > 0){
									img.get(0).src = url.url;
								}
								ipt.val(url.attachment);
								ipt.attr("filename",url.filename);
								ipt.attr("url",url.url);
								img.parent().show();
							}
							if(url.media_id){
								if(img.length > 0){
									img.get(0).src = "";
								}
								ipt.val(url.media_id);
							}
						}, null, options);
					});
				}
				function deleteImage(elm){
					require(["jquery"], function($){
						$(elm).prev().parent().hide();
						$(elm).parent().prev().find("input").val("");
					});
				}
			</script>';
			define('TPL_INIT_IMAGE', true);
		}

		$s .= '
			<div class="input-group ' . $options['class_extra'] . '">
				<input type="text" name="' . $name . '" value="' . $value . '"' . ($options['extras']['text'] ? $options['extras']['text'] : '') . ' class="form-control" autocomplete="off">
				<span class="input-group-btn">
					<button class="btn btn-default" type="button" onclick="showImageDialog(this);">选择图片</button>
				</span>
			</div>
			<div class="input-group ' . $options['class_extra'] . '" style="margin-top:.5em;'.$isshow.'">
				<img src="' . $val . '"  class="img-responsive img-thumbnail" ' . ($options['extras']['image'] ? $options['extras']['image'] : '') . ' width="80px" height="80px"/>
				<em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="deleteImage(this)">×</em>
			</div>';
		return $s;
	}	

 
}
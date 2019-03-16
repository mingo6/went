<?php
defined('YII_RUN') or exit('Access Denied');
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/6/19
 * Time: 16:52
 */
$urlManager = Yii::$app->urlManager;
$this->title = '设置页面';
$this->params['active_nav_group'] = 15;
$this->params['is_book'] = 2;
$this->params['isSiteTemp'] = 1;
?>
<style>
    .tip-block {
        height: 0;
        overflow: hidden;
        visibility: hidden;
    }

    .tip-block.active {
        height: auto;
        visibility: visible;
    }
    .tips{
        color:#8d8d8d;
    }
    .btn-delcache{
        min-width:90px;
        height:32px;
        line-height:32px;
        background:#44b549;
        color:white;
        cursor:pointer;
        border:none;
        border-radius:5px;
    }
</style>
<!-- <div class="main-nav" flex="cross:center dir:left box:first">
    <div>
        <nav class="breadcrumb rounded-0 mb-0" flex="cross:center">
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/store/index']) ?>">我的商城</a>
            <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/site/index/index']).'&id='.$_GET['id'].'&tid='.$_GET['tid'] ?>">官网</a>
            <span class="breadcrumb-item active"><?= $this->title ?></span>
        </nav>
    </div>
    <div>
        <?= $this->render('/layouts/nav-right') ?>
    </div>
</div> -->

<div class="main-body p-3">
    <form class="form card auto-submit-form" method="post" autocomplete="off" data-return="<?= $urlManager->createUrl(['mch/site/module/pagelist']) ?>">
        <div class="form-title white-bg">
            <div class="main-nav" flex="cross:center dir:left box:first">
                <div>
                    <nav class="breadcrumb rounded-0 mb-0" flex="cross:center" style="background-color: transparent;">
                        <span style="margin-right: 1rem">位置：</span>
                        <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/site/module/index']) ?>">我的模板</a>
                        <a class="breadcrumb-item" href="<?= $urlManager->createUrl(['mch/site/module/pagelist']).'&id='.$_GET['id'].'&tid='.$_GET['tid'] ?>">页面列表</a>
                        <span class="breadcrumb-item active"><?= $this->title ?></span>
                    </nav>
                </div>
            </div>
        </div>
        <link href="<?= Yii::$app->request->baseUrl ?>/statics/md/bootstrap.min.css?v=20180203" rel="stylesheet">
	    <link href="<?= Yii::$app->request->baseUrl ?>/statics/md/common_public.css?v=20180203" rel="stylesheet">
        <script type="text/javascript">
        window.sysinfo = {
            <?php if(!empty($_W['uniacid'])) echo '"uniacid":'.$_W['uniacid'].','; ?>
            <?php if(!empty($_W['acid'])) echo '"acid":'.$_W['acid'].','; ?>
            <?php if(!empty($_W['openid'])) echo 'openid:'.$_W['openid'].','; ?>
            <?php if(!empty($_W['uid'])) echo 'uid:'.$_W['uid'].','; ?>
            'isfounder': <?php echo !empty($_W['isfounder'])?1:0; ?>,
            'family': '<?php echo IMS_FAMILY ?>',
            'siteroot': '<?php echo $_W['siteroot'] ?>',
            'siteurl': '<?php echo $_W['siteurl'] ?>',
            'attachurl': '<?php echo $_W['attachurl'] ?>',
            'attachurl_local': '<?php echo $_W['attachurl_local'] ?>',
            'attachurl_remote': '<?php echo $_W['attachurl_remote'] ?>',
            'module' : {'url' : '<?php if(defined('MODULE_URL')) echo MODULE_URL ?>', 'name' : '<?php if(defined('IN_MODULE')) echo IN_MODULE ?>'},
            'cookie' : {'pre': '<?php echo $_W['config']['cookie']['pre'] ?>'},
            'account' : <?php echo json_encode($_W['account']) ?>,
            'server' : {'php' : '<?php echo phpversion() ?>'},
        };
        </script>
        <script>var require = { urlArgs: 'v=20180203' };</script>

        <script type="text/javascript">
            var page = <?php echo json_encode($page); ?>;
            var tempid = <?php echo intval( $_GET['tid'] ); ?>;
            var article = <?php echo json_encode($article); ?>;
            var allsort = <?php echo json_encode($allsort); ?>;
            var op = "<?php echo $_GET['op']; ?>";
        </script>
    
        <div class="form-body white-bg border-b-l border-b-r">
            <link href="<?= Yii::$app->request->baseUrl ?>/statics/md/style.css?t=1528273804" rel="stylesheet">

            <script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/jquery-1.11.1.min.js"></script>
            <script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/bootstrap.min.js"></script>
            <script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/util.js"></script>
            <script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/common.min.js"></script>
            <script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/require.js"></script>

            <link href="<?= Yii::$app->request->baseUrl ?>/statics/md/common.css?t=1528273804" rel="stylesheet">
            <link href="<?= Yii::$app->request->baseUrl ?>/statics/md/tao.css?t=1528273804" rel="stylesheet">
            <link href="<?= Yii::$app->request->baseUrl ?>/statics/md/jquery-ui.css" rel="stylesheet">
            <script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/jquery-ui.js"></script>
            <script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/tao.js?t=1527838941"></script>
            
            <script>
                window.UEDITOR_HOME_URL = '../web/statics/ueditor/';
            </script>
            <script src="<?= Yii::$app->request->baseUrl ?>/statics/ueditor/ueditor.config.js?v=1.9.6"></script>
            <script src="<?= Yii::$app->request->baseUrl ?>/statics/ueditor/ueditor.all.min.js?v=1.9.6"></script>
            <script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/zh-cn.js"></script>
            
            <script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/angular.min.js"></script>
            <script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/angular-ueditor.js"></script>
            <script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/sortable.js"></script>
            
            <script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/addart.js?t=1527838941"></script>
            <script charset="utf-8" src="<?= Yii::$app->request->baseUrl ?>/statics/md/jquery.zclip.min.js"></script>
            <script src="http://tongji.w7.cc/s.php?sid=3"></script>
            <script src="https://map.qq.com/api/js?v=2.exp"></script>
            <script src="http://open.map.qq.com/apifiles/2/4/91/main.js"></script>
            
            <div class="my_article_box" ng-app="myyapp" ng-controller="ctr">
                    <div class="" ng-cload>
                        <div class="item_cell_box">
                            <div class="article_left">
                                <div class="article_left_top" focus-item viewid="00000000" ng-click="getFocus('00000000','basic')">
                                    设置页面基本信息
                                </div>
                                <div class="article_left_mobile">
                                    <div class="mobile_top"></div>
                                    <div class="mobile_head">
                                        <span class="title" ng-cloak></span> 
                                    </div>
                                    <div class="page-content" style="padding: 5px">
                                        <div class="mobile_body">
                                            <div ng-repeat="item in items track by $index" ng-if="item.name != 'fix'"  ng-click="getFocus(item.id)"  class="view_item" viewid="{{item.id}}"  ng-class="{'article_view_selected' : focus.id == item.id}">
                                                <div  view-delete ng-mouseover="move(item.id)" ng-include="'./../web/temp/view-'+item.name+'.html'"></div>
                                                <div class="del_modules" ng-mousedown="delItem(item.id,$event)">删除</div>
                                            </div>
                                            <div ng-repeat="item in items track by $index" ng-if="item.name == 'fix'"  ng-click="getFocus(item.id)" class=" view_item_fix"   viewid="{{item.id}}"  ng-class="{'article_view_selected' : focus.id == item.id}" ng-style="{'background':item.params.mbg,'padding':item.params.padding+'px','top':item.params.top+'%','right':item.params.right+'%'}" >
                                                <div  view-delete ng-include="'./../web/temp/view-'+item.name+'.html'"></div>
                                                <div class="del_modules" ng-mousedown="delItem(item.id,$event)">删除</div>
                                            </div>
                                        </div>
                                    </div>                          
                                    <div class="mobile_bottom"></div>
                                </div>

                            </div>
                            <div class="article_right item_cell_flex">
                                <div class="portable_editor ">
                                    <div class="editor_inner" id="js_editFormContent">
                                        <div ng-include="'./../web/temp/edit-basic.html'" editid="00000000" ng-show="focus.id == '00000000'"></div>
                                        
                                        <div ng-repeat="item in items track by $index" class="edit_item simple" editid="{{item.id}}"  ng-show="focus.id == item.id" >
                                            <div ng-include="'./../web/temp/edit-'+item.name+'.html'"></div>
                                        </div>
                                    </div>
                                    <span class="editor_arrow_wrp js_arrow">
                                        <i class="editor_arrow editor_arrow_out"></i>
                                        <i class="editor_arrow editor_arrow_in"></i>
                                    </span>
                                </div>
                            </div>

                        </div>  

                        <div class="module_box" style="">
                            <li class="modules_list" ng-show="params.showmodules" ng-mouseleave="params.showmodules = false">
                                <span ng-repeat="item in modules" class="btn btn_default btn_p20" ng-bind="item.title" name="{{item.name}}" add-module></span>
                            </li>
                            <span class="btn btn_primary btn_p20" ng-click="params.showmodules = !params.showmodules">模块</span>
                            <span ng-click="saveData()" class="btn btn_primary btn_p20">保存</span>
                        </div>
                    </div>


                    <div class="my_model" url style="display: none">
                        <div class=" ui-draggable " >
                            <div class="dialog">
                                <div class="dialog_hd">
                                    <a href="javascript:;" class="icon16_opr closed pop_closed model_close" >关闭</a>
                                </div>
                                <div class="dialog_bd info_box item_cell_box" >
                                    <div class="setlink_l">
                                        <li ng-class="seturltype == 'page' ? 'setlink_act' : ''" ng-click="pagetype('page')">程序页面</li>
                                        <li  ng-class="seturltype == 'news' ? 'setlink_act' : ''" ng-click="pagetype('news')">文章页面</li>
                                        <li  ng-class="seturltype == 'other' ? 'setlink_act' : ''" ng-click="pagetype('other')">其他页面</li>
                                    </div>
                                    <div class="setlink_r item_cell_flex">
                                        <div ng-show="urltype == 'my' && seturltype == 'page'" ng-repeat="item in allpage" class="item_cell_box setlink_r_item">
                                            <li>{{item.name}}</li>
                                            <li class="setlink_r_box item_cell_flex">
                                                <span ng-click="setLink(item.url,item.name)">选择</span>
                                            </li>
                                        </div>
                                        <div ng-show="urltype == 'my' && seturltype == 'news'" ng-repeat="item in allnews" class="item_cell_box setlink_r_item">
                                            <li>{{item.title}}</li>
                                            <li class="setlink_r_box item_cell_flex">
                                                <span ng-click="setLink(item.url,item.title)">选择</span>
                                            </li>
                                        </div>
                                        <div ng-show="urltype == 'my' && seturltype == 'other'" ng-repeat="item in otherurl" class="item_cell_box setlink_r_item">
                                            <li>{{item.title}}</li>
                                            <li class="setlink_r_box item_cell_flex">
                                                <span ng-click="setLink(item.url,item.title)">选择</span>
                                            </li>
                                        </div>                              
                                        <div ng-show="urltype == 'app'" ng-repeat="item in allapp" class=" setlink_r_item">
                                            <div ng-repeat="initem in item.list" class="item_cell_box">
                                                <li>
                                                    <img class="setlink_logoimg" ng-src="{{item.logo}}">
                                                </li>
                                                <li class="setlink_in_item setlink_in_mname">{{item.appname}}</li>
                                                <li class="setlink_in_item">{{initem.title}}</li>
                                                <li class="setlink_in_item">{{initem.url}}</li>
                                                <li class="setlink_r_box item_cell_flex setlink_in_item">
                                                    <span ng-click="setotherLink(item,initem)">选择</span>
                                                </li>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="dialog_ft">
                                    <span class="btn btn_default btn_input js_btn_p model_close" >
                                        <button type="button" class="js_btn">取消</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mask ui-draggable" style="display: block;"></div>
                    </div>
                    <div class="my_model" loadpage style="display: none">
                        <div class=" ui-draggable " >
                            <div class="dialog">
                                <div class="dialog_hd">
                                    <a href="javascript:;" class="icon16_opr closed pop_closed model_close" >关闭</a>
                                </div>
                                <div class="dialog_bd info_box item_cell_box" >
                                    <div class="setlink_l">
                                        <li class="setlink_act" >页面列表</li>
                                    </div>
                                    <div class="setlink_r item_cell_flex">
                                        <div ng-repeat="item in loadpagelist" class="item_cell_box setlink_r_item">
                                            <div class="model_temp_name">{{item.name}}</div>
                                            <div class="setlink_r_box item_cell_flex " >
                                                <div class="item_cell_box setlink_r_item" ng-repeat="inn in item.page">
                                                    <div>{{inn.name}}</div>
                                                    <div class="setlink_r_box item_cell_flex " >
                                                        <span ng-click="loadPageByid(inn.id)">选择</span>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="dialog_ft">
                                    <span class="btn btn_default btn_input js_btn_p model_close" >
                                        <button type="button" class="js_btn">取消</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mask ui-draggable" style="display: block;"></div>
                    </div>  

                    <div class="my_model" map style="display: none">
                        <div class=" ui-draggable " >
                            <div class="dialog">
                                <div class="dialog_hd">
                                    <a href="javascript:;" class="icon16_opr closed pop_closed model_close" >关闭</a>
                                </div>
                                <div class="dialog_bd info_box" >
                                    <div class="font_mini">左键点击所在出现红色标记，点击确定即可</div>
                                    <div class="map_box" style="margin: 0 auto;">
                                        <!-- <div class="map_search">
                                            <span class="frm_input_box frm_input_box_100">
                                                <input type="text" class="frm_input"  name="searaddress" value="">
                                            </span><a href="javascript:;" id="find_address">搜索</a>
                                        </div>
                                        <div class="baidu_map" id="map"></div> -->
                                        <div class="map_search">
                                            <span class="frm_input_box frm_input_box_100">
                                                <input type="text" class="frm_input"  name="searaddress" id="searaddress" value="">
                                            </span><a href="javascript:;" id="find_address">搜索</a>
                                        </div>
                                        <div class="baidu_map" id="map"></div>
                                    </div>
                                </div>
                                <div class="dialog_ft">
                                    <span class="btn btn_primary btn_input js_btn_p" ng-click="setLocation()">
                                        <button type="button" class="js_btn">确定</button>
                                    </span>
                                    <span class="btn btn_default btn_input js_btn_p model_close" >
                                        <button type="button" class="js_btn">取消</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mask ui-draggable" style="display: block;"></div>
                    </div>

            </div>
            <!-- end -->
        </div>
    </form>

    <!-- start -->
    <!-- <link href="<?= Yii::$app->request->baseUrl ?>/statics/md/common.css" rel="stylesheet">
	<link href="<?= Yii::$app->request->baseUrl ?>/statics/md/tao.css" rel="stylesheet"> -->
	
	

</div>



<script>
    $(document).on('click', '.show-tip', function () {
        var tip = $(this).attr('data-tip');
        if ($('#' + tip).hasClass('active')) {
            $('#' + tip).removeClass('active');
        } else {
            $('#' + tip).addClass('active');
        }
    });
</script>
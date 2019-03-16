<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<?php  if($op == 'list') { ?>
<form action="" class="form-table form form-validate" method="post">
    <div class="panel panel-table">
        <div class="panel-heading">
            <a href="<?php  echo iurl('errander/type/post');?>" class="btn btn-primary btn-sm">添加新类型</a>
        </div>
        <div class="panel-body table-responsive js-table">
            <?php  if(empty($categorys)) { ?>
            <div class="no-result">
                <p>还没有相关数据</p>
            </div>
            <?php  } else { ?>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>id</th>
                    <th>图标</th>
                    <th>类型名称</th>
                    <th>对应的配送员名称</th>
                    <th>字段名</th>
                    <th class="text-right">操作</th>
                </tr>
                </thead>
                <?php  if(is_array($categorys)) { foreach($categorys as $category) { ?>
                <tr>
                    <input type="hidden" name="ids[]" value="<?php  echo $category['id'];?>">
                    <td><?php  echo $category['id'];?></td>
                    <td>
                        <img src="<?php  echo tomedia($category['thumb']);?>" width="50">
                    </td>
                    <td><?php  echo $category['errander_name'];?></td>
                    <td><?php  echo $category['deliveryer_name'];?></td>
                    <td><?php  echo $category['value'];?></td>
                    <td class="text-right">
                        <a href="<?php  echo iurl('errander/type/post', array('id' => $category['id']))?>" class="btn btn-default btn-sm" title="编辑" data-toggle="tooltip" data-placement="top" ><i class="fa fa-edit"> </i> 编辑</a>
                        <a href="<?php  echo iurl('errander/type/del', array('id' => $category['id']))?>" class="btn btn-default btn-sm js-remove" data-confirm="确定删除该类型?"><i class="fa fa-times"> </i> 删除</a>
                    </td>
                </tr>
                <?php  } } ?>
            </table>
            <div class="btn-region clearfix">
                <div class="pull-left">
                    <!--<input type="submit" class="btn btn-primary btn-sm" name="submit" value="提交修改" />-->
                </div>
            </div>
            <?php  } ?>
        </div>
    </div>
</form>
<?php  } ?>

<?php  if($op == 'post') { ?>
<div class="page clearfix">
    <h2>编辑类型</h2>
    <form class="form-horizontal form form-validate" id="form1" action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">类型名称</label>
            <div class="col-sm-9 col-xs-12">
                <input type="text" class="form-control" name="errander_name" value="<?php  echo $category['errander_name'];?>" required="true">
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">对应的配送员名称</label>
            <div class="col-sm-9 col-xs-12">
                <input type="text" class="form-control" name="deliveryer_name" value="<?php  echo $category['deliveryer_name'];?>" required="true">
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">图标</label>
            <div class="col-sm-9 col-xs-12">
                <?php  echo tpl_form_field_image('thumb', $category['thumb']);?>
                <div class="help-block"></div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">字段名</label>
            <div class="col-sm-9 col-xs-12">
                <input type="text" class="form-control" name="value" value="<?php  echo $category['value'];?>" required="true">
                <div class="help-block">请填写字母，如buy</div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-9 col-xs-9 col-md-9">
                <input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
                <input type="submit" value="提交" class="btn btn-primary">
            </div>
        </div>
    </form>
</div>
<?php  } ?>

<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
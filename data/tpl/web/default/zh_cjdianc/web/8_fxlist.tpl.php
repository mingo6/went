<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/header', TEMPLATE_INCLUDEPATH)) : (include template('public/header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('public/comhead', TEMPLATE_INCLUDEPATH)) : (include template('public/comhead', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" type="text/css" href="../addons/zh_cjdianc/template/public/ygcsslist.css">
<style type="text/css">
      .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td{
              vertical-align: middle;
      }
    .yg5_tabel{border: none;outline: none;text-align: center;}
    .yg5_tr2>td{padding: 10px 5px;border-bottom: 1px solid #e5e5e5;}
    .yg5_tr1>th{
        text-align: center;
        vertical-align: middle;
        font-weight: normal;
    }
    td p,
    .yg5_tr1>th p{
      margin:0;
    }
    .yg5_btn{background-color: #EEEEEE;color: #333;border: 1px solid #E4E4E4;border-radius: 6px;width: 100px;height: 34px;}
    .check_img{width: 45px;height: 45px;}
    .fxmain{background-color: white;}
    .panel{box-shadow: 0 0px 0px;}
    .fxrow{padding: 15px;}
    .fxuserimg{width: 30px;height: 30px;border-radius: 50%;border:1px solid #ccc;}
    .fxuserimg2{width: 30px;height: 30px;border-radius: 50%;border:1px solid #ccc;margin-right: 10px;}
    .fxfont1{color: #eb6060;}
    .fxfont2{color: #ffc000;}
    .recharge_info{display: -webkit-flex;display: -webkit-box;display: -ms-flexbox;display: flex;justify-content: space-around;margin-bottom: 10px;}
    .recharge_info>div{-webkit-box-flex:1;-webkit-flex:1;-ms-flex:1;flex:1;border:1px solid #efefef;margin:0 10px;padding: 10px 22px;line-height: 25px;color: #333;width: 310px;height: 97px;}
    .tabs-container{border-bottom: 1px solid #e5e5e5;padding: 10px;}
    .fxnum{line-height: 30px;font-size: 14px;}
    .blue:hover,
    .blue{
      background: #44ABF7;
      color: #fff;
      padding: 8px;
      border-top-left-radius: 5px;
      border-top-right-radius: 5px;
    }
    .cancel{
      position: relative;
      border: 1px solid #ccc;
      width: 70px;
      margin: 0 auto;
      font-size: 15px;
      cursor: pointer;
    }
    .caozuo{
      position: relative;
    }
    .caozuo_select{
      position: absolute;
      border: 1px solid #e5e5e5;
      background: #fff;
      padding: 6px 22px;
      top: 42px;
      left: 50%;
      margin-left: -45px;
      font-size: 14px;
      display: none;
      z-index: 10
    }
    .icon{
      position: absolute;
      top:0;
      margin-left: 5px;
    }
    .lists{
      border-bottom: 1px solid #ddd;
      display: flex;
      height: 30px;
    }
    .lists li{
      margin: 0 0 -1px 0;
      background: #f8f8f8;
      height: 30px;
      width: 80px;
    }
    .lists li a{
      color: #464a4c;
      border: 1px solid #ddd;
      float: left;
      width: 100%;
      height: 100%;
      text-align: center;
      line-height: 30px;
    }
    .lists li a.on{
      border-color: #ddd #ddd #fff;
      background-color: #fff;
    }
    .xiaxian td{
      text-align: center;
    }
    .team{
      display: block;
    }
    .pa_0{
    	padding: 20px 0;
    }
    .pa_0 input{
    	border-top: 1px solid #e5e5e5;
    }
</style>
<ul class="nav nav-tabs">
  <span class="ygxian"></span>
  <div class="ygdangq">当前位置:</div>
  <li class="active"><a href="javascript:void(0);">全部</a></li>
  </ul>
  <div class="main fxmain" style="padding: 1px 30px;">
    <div class="row fxrow">
        <div class="col-lg-12" style="padding: 0">
            <form action="" method="get" class="col-md-2" style="padding: 0">
                <input type="hidden" name="c" value="site" />
                       <input type="hidden" name="a" value="entry" />
                       <input type="hidden" name="m" value="zh_cjdianc" />
                       <input type="hidden" name="do" value="fxlist" />
                <div class="input-group">
                    <input type="text" name="keywords" class="form-control" placeholder="请输入微信昵称/姓名" value="<?php  echo $_GPC['keywords'];?>">
                    <span class="input-group-btn">
                        <input type="submit" class="btn btn-default blue" name="submit" value="查找"/>
                    </span>
                </div>
                <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
            </form>
            <button class="btn btn-default blue" id="allselect" style="margin-left: 20px;">批量通过</button>
        </div><!-- /.col-lg-6 -->
    </div>  

    <!--主体列表-->
    <div class="mb-4">
        <ul class="lists">
            <li class="nav-item">
                <a<?php  if($state=='all') { ?> class="on" <?php  } ?> href="<?php  echo $this->createWebUrl('fxlist',array('state'=>'all'));?>">全部</a>
            </li>
            <li class="nav-item">
                <a <?php  if($state=='1') { ?> class="on" <?php  } ?> href="<?php  echo $this->createWebUrl('fxlist',array('state'=>1));?>">未审核</a>
            </li>
            <li class="nav-item">
                <a <?php  if($state=='2') { ?> class="on" <?php  } ?> href="<?php  echo $this->createWebUrl('fxlist',array('state'=>2));?>">已审核</a>
            </li>
        </ul>
    </div>    
    <div class="" style="">
        <div class="panel">
            <div class="panel-body" style="">
                <div class="row">
                  <table class="yg5_tabel col-md-12 table table-bordered">
                        <tr class="yg5_tr1">
                            <th class="store_td1" style="width: 200px">
                                <input type="checkbox" class="allcheck" />
                                <span class="store_inp">全选</span>
                            </th>
                        <!-- 批量部分 -->
                            <th class="store_td1 col-md-2" >微信信息</th>
                            <th class="col-md-1">
                              <p>姓名</p>
                              <p>手机号</p>
                            </th>
                            <th class="store_td1 col-md-1">
                              <p>累计佣金</p>
                              <p>可提现佣金</p>
                            </th>
                            <th class="col-md-2">推荐人</th>
                            <th class="col-md-1">下级用户</th>
                            <th class="col-md-1">状态</th>
                            <th class="col-md-2">时间</th>
                            <th class="" style="width: 400px">操作</th>
                        </tr>
                        <?php  if(is_array($list)) { foreach($list as $key => $item) { ?>
    
                        <tr class="yg5_tr2">
                            <td>
                                <input type="checkbox" name="test" value="<?php  echo $item['id'];?>">
                            </td>                      
                          <td class="fxfont3">
                          <img class="fxuserimg" src="<?php  echo $item['img'];?>">
                          <?php  echo $item['name'];?></td>
                         <td class="store_td1">
                          <p><?php  echo $item['user_name'];?></p>
                          <p><?php  echo $item['user_tel'];?></p>
                         </td>
                         <td>
                           
                            <span class=""><?php  echo $item['yxjy']?></span><br/>
                             <span class=""><?php  echo $item['yxjy']-$item['tx']?></span>
                         </td>
                         <td>                 
                       <?php  echo $item['sj'];?>
                         </td>
                             <td>                 
                          <a class="team myModalb<?php  echo $item['user_id'];?>" href="javascript:void(0);" data-toggle="modal" data-target="#myModalb">一级：<?php  echo $item['xjrs'];?></a>
                          <script type="text/javascript">
                              $(function(){
                                    $(".myModalb<?php  echo $item['user_id'];?>").each(function(index){
                                        $(this).click(function(){            
                                            id = <?php  echo $item['user_id'];?>;
                                            $.ajax({
                                                type:"post",
                                                url:"<?php  echo $_W['siteroot'];?>/app/index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=GetYj&m=zh_cjdianc",
                                                dataType:"json",
                                                data:{user_id:id},
                                                success:function(data){
                                                    console.log(data);
                                                    var con=data;
                                                    $(".xiaxian tbody").html("");
                                                    if(con.length==0){
                                                      $(".xiaxian tbody").append('<tr><td colspan="5">'+"暂无数据"+'</td></tr>')
                                                    }else{
                                                    for(var i=0;i<con.length;i++){
                                                      $(".xiaxian tbody").append('<tr><td>'+i+'</td><td>'+con[i].fx_name+'</td><td>一级</td><td>'+con[i].yj_name+'</td><td>'+con[i].time+'</td></tr>')
                                                    }  
                                                  }
                                                }
                                            })
                                    
                                        });
                                    });
                                })

                          </script>
                          <?php  if($sys['is_ej']==2) { ?>
                             <a class="team mytip<?php  echo $item['user_id'];?>" href="javascript:void(0);" data-toggle="modal" data-target="#myModalb">二级：<?php  echo $item['ejrs'];?></a>
                          <script type="text/javascript">
                              $(function(){
                                    $(".mytip<?php  echo $item['user_id'];?>").each(function(index){
                                        $(this).click(function(){            
                                            id2 = <?php  echo $item['user_id'];?>;
                                            //console.log(id2)
                                            $.ajax({
                                                type:"post",
                                                url:"<?php  echo $_W['siteroot'];?>/app/index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=GetEj&m=zh_cjdianc",
                                                dataType:"json",
                                                data:{user_id:id2},
                                                success:function(data){
                                                    console.log(data);
                                                    var con=data;
                                                    $(".xiaxian tbody").html("");
                                                    if(con==null){
                                                      $(".xiaxian tbody").append('<tr><td colspan="5">'+"暂无数据"+'</td></tr>')
                                                    }else{
                                                    for(var i=0;i<con.length;i++){
                                                      $(".xiaxian tbody").append('<tr><td>'+i+'</td><td>'+con[i].fx_name+'</td><td>二级</td><td>'+con[i].yj_name+'</td><td>'+con[i].time+'</td></tr>')
                                                    }  
                                                  }                                                  
                                                }
                                            })
                                    
                                        });
                                    });
                                })

                          </script>
                          <?php  } ?>

                         </td>
                    
                         <?php  if($item['state']==1) { ?>
                         <td>
                            <span class="label storered">待审核</span>
                        </td >
                        <?php  } else if($item['state']==2) { ?>
                        <td >
                            <span class="label storeblue">已通过</span>
                        </td>
                        <?php  } else if($item['state']==3) { ?>
                        <td >
                           <span class="label storegrey">已拒绝</span>
                       </td>

                       <?php  } ?>  
                            <td>
                             <p>申请时间:<?php  echo date("Y-m-d H:i:s",$item['time'])?></p>
                             <?php  if($item['sh_time']) { ?>
                          <p>审核时间:<?php  echo date("Y-m-d H:i:s",$item['sh_time'])?></p>
                          <?php  } ?>
                            </td>
                             <td class="caozuo">     
                                <div class="cancel">操作 <i class="fa fa-sort-desc icon" aria-hidden="true"></i></div>  
                                <ul class="caozuo_select">
                                 <?php  if($item['state']==2) { ?>
                                 <li><a href="<?php  echo $this->createWebUrl('fxorder',array('user_id'=>$item['user_id'],'op'=>'adopt'));?>">分销订单</a></li>
                                 <li><a href="<?php  echo $this->createWebUrl('fxtx');?>">提现明细</a></li>
                                 <li>  <a href="javascript:;"  data-toggle="modal" data-target="#myModal<?php  echo $item['id'];?>">
                                  充值金额              
                      </a></li>
                                   <?php  } ?>
                                 <?php  if($item['state']==1) { ?>
                                 <li><a href="<?php  echo $this->createWebUrl('fxlist',array('id'=>$item['id'],'op'=>'adopt'));?>" onclick="return confirm('确认审核通过吗？');return false;">审核通过</a></li>
                                 <li><a href="<?php  echo $this->createWebUrl('fxlist',array('id'=>$item['id'],'op'=>'reject'));?>" onclick="return confirm('确认不通过吗？');return false;">不通过</a></li>
                                 <?php  } ?>
                                 <li><a href="<?php  echo $this->createWebUrl('fxlist', array('id' => $item['id'],'op'=>'delete'))?>" class="" onclick="return confirm('确认删除吗？');return false;" title="删除">删除</a></li>
                               </ul>         
                            </td>
                          </tr>


      <div class="modal fade" id="myModal<?php  echo $item['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          &times;
        </button>
        <h4 class="modal-title" id="myModalLabel">
          编辑信息
        </h4>
      </div>
      <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="qs_box col-md-12 pa_0">
            <label for="" class="col-md-3">姓名 :</label>
            <input type="text" value="<?php  echo $item['name'];?>" name="name" class="col-md-6 con" readonly="readonly">
          </div>
          <div class="qs_box col-md-12 pa_0">
            <label for="" class="col-md-3">充值金额 :</label>
            <input type="text" value="<?php  echo $item['money'];?>" name="money" class="col-md-6 con">
          </div>          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">取消
          </button>
          <input type="submit" class="btn btn-primary" value="确定" name="submit">
        </div>
        <input type="hidden" name="user_id" value="<?php  echo $item['user_id'];?>"/>
        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>"/>
      </form>
    </div>
  </div>
</div>

                          <?php  } } ?>
                          <?php  if(empty($list)) { ?>
                          <tr class="yg5_tr2">
                            <td colspan="9">
                              暂无数据
                          </td>
                      </tr> 
                      <?php  } ?>        
                  </table>
              </div>
            </div>
        </div>
    </div>



    <!--下线弹框-->
    <div class="modal fade" id="myModalb" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              &times;
            </button>
            <h4 class="modal-title" id="myModalLabel">
              下线情况
            </h4>
          </div>
          <div class="modal-body">
             <table class="table table-bordered xiaxian">
                <thead>
                  <tr>
                    <td>序号</td> 
                    <td>分销商</td> 
                    <td>下线等级</td> 
                    <td>昵称</td> 
                    <td>加入时间</td>
                  </tr> 
                </thead>
                <tbody>

                </tbody>
              </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭
            </button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal -->
    </div>

    <div class="text-right we7-margin-top">
       <?php  echo $pager;?>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        // $("#frame-9").addClass("in");
        $("#frame-9").show();
        $("#yframe-9").addClass("wyactive");

         $("#allselect").on('click',function(){
            var check = $("input[type=checkbox][class!=allcheck]:checked");
            if(check.length < 1){
                alert('请选择要通过的分销商!');
                return false;
            }else if(confirm("确认要通过此分销商?")){
                var id = new Array();
                check.each(function(i){
                    id[i] = $(this).val();
                });
                //console.log(id)
                $.ajax({
                    type:"post",
                    url:"<?php  echo $_W['siteroot'];?>/app/index.php?i=<?php  echo $_W['uniacid'];?>&c=entry&do=AllAdopt&m=zh_cjdianc",
                    dataType:"text",
                    data:{id:id},
                    success:function(data){
                        console.log(data);      
                        location.reload();
                    }
                })
               
            }
        });
        $(".allcheck").on('click',function(){
            var checked = $(this).get(0).checked;
            $("input[type=checkbox]").prop("checked",checked);
        });

        $(".cancel").click(function(e){
          var state=$(this).siblings(".caozuo_select").css("display")
          if(state=="none"){
            $(this).siblings(".caozuo_select").show()
          }else{
            $(this).siblings(".caozuo_select").hide()
          }
        })

        $(".caozuo_select li").click(function(){
          $(".caozuo_select").hide()
        })
    })
</script>
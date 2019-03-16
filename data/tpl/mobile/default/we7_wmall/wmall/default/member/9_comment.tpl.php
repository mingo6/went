<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page my-comment" id="page-app-my-comment">
	<header class="bar bar-nav">
		<a class="pull-left back" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title">我的评论</h1>
	</header>
	<?php  get_mall_menu();?>
	<div class="content infinite-scroll js-infinite" data-href="<?php  echo imurl('wmall/member/comment/more');?>" data-distance="50" data-min="<?php  echo $min;?>" data-container=".comment-list" data-tpl="tpl-comment">
		<?php  if(empty($comments)) { ?>
			<div class="common-no-con">
				<img src= "<?php echo WE7_WMALL_TPL_URL;?>static/img/comment_no_con.png" alt="" />
				<p>您还没有评论过，快去评论吧！</p>
			</div>
		<?php  } else { ?>
			<div class="comment-list">
				<?php  if(is_array($comments)) { foreach($comments as $key => $comment) { ?>
					<div class="comment-inner border-1px-b">
						<div class="store-title">
							<?php  echo $comment['title'];?><span class="date color-muted"><?php  echo date('Y-m-d H:i', $comment['addtime']);?></span>
						</div>
						<div>
							<div class="star-rank">
								<span class="star-rank-outline">
									<span class="star-rank-active" style="width:<?php  echo $comment['score'];?>%"></span>
								</span>
							</div>
							<span class="color-muted hide">送货速度:40分钟</span>
						</div>
						<div class="color-muted">送货：<?php  echo $comment['delivery_service'];?>分&nbsp;&nbsp;商品：<?php  echo $comment['goods_quality'];?>分</div>
						<?php  if(!empty($comment['note'])) { ?>
							<div class="comment-info"><?php  echo $comment['note'];?></div>
						<?php  } ?>
						<?php  if(!empty($comment['data']['good'])) { ?>
							<div class="comment-favor-oppose">
								<i class="icon favor"></i>
								<?php  if(is_array($comment['data']['good'])) { foreach($comment['data']['good'] as $good) { ?>
									<span><?php  echo $good;?></span>
								<?php  } } ?>
							</div>
						<?php  } ?>
						<?php  if(!empty($comment['data']['bad'])) { ?>
							<div class="comment-favor-oppose">
								<i class="icon oppose"></i>
								<?php  if(is_array($comment['data']['bad'])) { foreach($comment['data']['bad'] as $bad) { ?>
								<span><?php  echo $bad;?></span>
								<?php  } } ?>
							</div>
						<?php  } ?>
						<?php  if(!empty($comment['thumbs'])) { ?>
							<div class="comment-images-containter row">
								<?php  if(is_array($comment['thumbs'])) { foreach($comment['thumbs'] as $thumb) { ?>
								<div class="col-33 photoBrowser-image-item">
									<img src="<?php  echo $thumb;?>" alt=""/>
								</div>
								<?php  } } ?>
							</div>
						<?php  } ?>
						<?php  if(!empty($comment['reply'])) { ?>
							<div class="store-comment">
								<div class="clearfix store-comment-top">
									店家回复：<span class="pull-right"><?php  echo date('Y-m-d H:i', $comment['replytime']);?></span>
								</div>
								<div class="info"><?php  echo $comment['reply'];?></div>
							</div>
						<?php  } ?>
					</div>
				<?php  } } ?>
			</div>
			<div class="infinite-scroll-preloader hide">
				<div class="preloader"></div>
			</div>
		<?php  } ?>
	</div>
</div>

<script id="tpl-comment" type="text/html">
	<{# for(var i = 0, len = d.length; i < len; i++){ }>
	<div class="comment-inner border-1px-b">
		<div class="store-title">
			<{d[i].title}><span class="date color-muted"><{d[i].addtime_cn}></span>
		</div>
		<div>
			<div class="star-rank">
			<span class="star-rank-outline">
				<span class="star-rank-active" style="width:<{d[i].id}>%"></span>
			</span>
			</div>
			<span class="color-muted hide">送货速度:40分钟</span>
		</div>
		<div class="color-muted">送货：<{d[i].delivery_service}>分&nbsp;&nbsp;商品：<{d[i].goods_quality}>分</div>
		<{# if(d[i].note != ''){ }>
			<div class="comment-info"><{d[i].note}></div>
		<{# } }>
		<{# if(d[i].data && d[i].data.good && d[i].data.good.length > 0){ }>
			<div class="comment-favor-oppose">
				<i class="icon favor"></i>
				<{# for(var j = 0, lenj = d[i].data.good.length; j < lenj; j++){ }>
					<span><{d[i].data.good[j]}></span>
				<{# } }>
			</div>
		<{# } }>
		<{# if(d[i].data && d[i].data.bad && d[i].data.bad.length > 0){ }>
			<div class="comment-favor-oppose">
				<i class="icon oppose"></i>
				<{# for(var j = 0, lenj = d[i].data.bad.length; j < lenj; j++){ }>
					<span><{d[i].data.bad[j]}></span>
				<{# } }>
			</div>
		<{# } }>
		<{# if(d[i].thumbs && d[i].thumbs.length > 0){ }>
			<div class="comment-images-containter row">
				<{# for(var j = 0, lenj = d[i].thumbs.length; j < lenj; j++){ }>
					<div class="col-33 photoBrowser-image-item">
						<img src="<{d[i].thumbs[j]}>" alt=""/>
					</div>
				<{# } }>
			</div>
		<{# } }>
		<{# if(d[i].reply != ''){ }>
			<div class="store-comment">
				<div class="clearfix store-comment-top">
					店家回复：<span class="pull-right"><{d[i].replytime_cn}></span>
				</div>
				<div class="info"><{d[i].reply}></div>
			</div>
		<{# } }>
	</div>
	<{# } }>
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page add-comment" id="page-app-add-comment">
	<header class="bar bar-nav">
		<a class="pull-left back" href="javascript:;"><i class="icon icon-arrow-left"></i></a>
		<h1 class="title">添加评论</h1>
	</header>
	<?php  get_mall_menu();?>
	<div class="content">
		<div class="content-block-title">配送评价</div>
		<div class="list-block delivery-comment">
			<ul class="border-1px-tb">
				<li class="item-content">
					<div class="item-inner">
						<div class="item-title">
							配送服务
							<div class="star-comment">
								<div class="star-outline" data-name="delivery_service">
									<label>
										<input type="radio" class="radio" value="1">
										<span></span>
									</label>
									<label>
										<input type="radio" class="radio" value="2">
										<span></span>
									</label>
									<label>
										<input type="radio" class="radio" value="3">
										<span></span>
									</label>
									<label>
										<input type="radio" class="radio" value="4">
										<span></span>
									</label>
									<label>
										<input type="radio" class="radio" value="5">
										<span></span>
									</label>
								</div>
							</div>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<div class="content-block-title">商品评价</div>
		<div class="goods-comment border-1px-tb">
			<div class="quality-comment">
				商品质量
				<div class="star-comment">
					<div class="star-outline" data-name="goods_quality">
						<label>
							<input type="radio" class="radio" value="1">
							<span></span>
						</label>
						<label>
							<input type="radio" class="radio" value="2">
							<span></span>
						</label>
						<label>
							<input type="radio" class="radio" value="3">
							<span></span>
						</label>
						<label>
							<input type="radio" class="radio" value="4">
							<span></span>
						</label>
						<label>
							<input type="radio" class="radio" value="5">
							<span></span>
						</label>
					</div>
				</div>
			</div>
			<div class="comment-list">
				<?php  if(is_array($goods)) { foreach($goods as $good) { ?>
				<div class="row no-gutter goods-list" data-id="<?php  echo $good['id'];?>">
					<div class="col-50"><?php  echo $good['goods_title'];?></div>
					<div class="col-50">
						<div class="favor-oppose">
							<label>
								<input type="radio" class="radio" name="goods[<?php  echo $good['id'];?>]" value="1">
								<span class="favor"></span>
							</label>
							<label>
								<input type="radio" class="radio" name="goods[<?php  echo $good['id'];?>]" value="2">
								<span class="oppose"></span>
							</label>
						</div>
					</div>
				</div>
				<?php  } } ?>
			</div>
		</div>
		<div class="content-block-title">写点什么</div>
		<textarea name="note" class="note border-1px-tb" value="" placeholder="至少输入10个字,您的建议很重要,来点评一下吧!"></textarea>
		<div class="content-block-title" style="margin-top: .3rem">有图有真相</div>
		<?php  echo tpl_mutil_image('thumbs', array(), 4);?>
		<div class="content-padded">
			<a href="javascript:;" class="button button-fill button-big button-danger submit-com" data-id="<?php  echo $order['id'];?>">提交评论</a>
		</div>
	</div>
</div>
<script>
require(['order'], function(order){
	order.initComment();
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
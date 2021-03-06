<?php defined('IN_IA') or exit('Access Denied');?><?php  include itemplate('public/header', TEMPLATE_INCLUDEPATH);?>
<div class="page search-result search-hot">
	<div class="bar bar-header-secondary">
		<div class="searchbar">
			<a class="searchbar-arrow back"><i class="icon icon-arrow-left"></i></a>
			<a class="searchbar-cancel">搜索</a>
			<div class="search-input">
				<label class="icon icon-search" for="search"></label>
				<input type="search" id='search' name="search" placeholder='请输入商户或商品名称'/>
			</div>
		</div>
	</div>
	<?php  get_mall_menu();?>
	<div class="content">
		<?php  if(!empty($stores)) { ?>
			<div class="search-tag">
				<div class="search-tag-title">热门搜索</div>
				<?php  if(is_array($stores)) { foreach($stores as $store) { ?>
					<span class="search-history" data-value="<?php  echo $store['title'];?>"><a href="javascript:;"><?php  echo $store['title'];?></a></span>
				<?php  } } ?>
			</div>
		<?php  } ?>
		<?php  if(!empty($member['search_data'])) { ?>
			<div class="search-text-list">
				<ul>
					<?php  if(is_array($member['search_data'])) { foreach($member['search_data'] as $data) { ?>
						<li class="search-history" data-value="<?php  echo $data;?>"><a href="javascript:;"><i class="icon icon-time"></i> <?php  echo $data;?></a></li>
					<?php  } ?>
					<li class="last-item"><a href="javascript:;" id="truncate-search-data">清空历史记录</a></li>
				</ul>
			</div>
		<?php  } } ?>
	</div>
</div>
<script>
$(function(){
	$(document).on('click', '#truncate-search-data', function(){
		$.post("<?php  echo imurl('wmall/home/hunt/truncate');?>", {}, function(data){
			$('.search-text-list').remove();
		});
	});
	$(document).on('click', '.search-history', function(){
		var value = $(this).data('value');
		if(!value) {
			return false;
		}
		$('.search-input input').val(value);
		setTimeout(function(){
			$('.searchbar-cancel').trigger('click');
		}, 200)
	});

	$(document).on('click', '.searchbar-cancel', function(){
		var key = $('.search-input input').val();
		if(!key) {
			return false;
		}
		$.showIndicator();
		$.post("<?php  echo imurl('wmall/home/hunt/search_data');?>", {key: key}, function(data){
			location.href = "<?php  echo imurl('wmall/home/hunt/search');?>&key=" + key;
		});
		return false;
	});
});
</script>
<?php  include itemplate('public/footer', TEMPLATE_INCLUDEPATH);?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>店铺信息</title>
		<link href="<?php echo base_url() ?>public/app/css/mui.min.css" rel="stylesheet" />
		<link href="<?php echo base_url() ?>public/app/css/custom.css" rel="stylesheet" />
	</head>

	<body>
		<header class="mui-bar mui-bar-nav mui-badge-danger">
			<!-- <h1 class="mui-title">店铺信息</h1> -->
			<a class="mui-btn mui-btn-link mui-btn-nav mui-pull-left" href="sergoodslist">
				<span class="mui-icon mui-icon-left-nav"></span>商品列表
			</a>
			<input type="hidden" id="shopID" value="<?php echo $shopID ?>" />
		</header>
		<div class="mui-content">
			<div id="store-info"></div>
			<div id="store-goods-list">
				<div id="my-nav-box" class="margin-t-5">
					<div class="mui-pull-left my-nav mui-col-xs-4 select" data-type="0">综合排序</div>
					<div class="mui-pull-left my-nav mui-col-xs-4" data-type="4">销量优先</div>
					<div class="mui-pull-left my-nav mui-col-xs-4 price-desc" data-type="2">价格排序</div>
				</div>
				<div id="pullrefresh" class="mui-scroll-wrapper">
					<div class="mui-scroll">
						<!--数据加载-->
						<div id="my-card" class="my-card">
							<ul id="goods-box" class="mui-table-view my-view-white"></ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="shade"></div>
		<div id="onload">
			<div class="onload-box">
				<span class="mui-spinner"></span>
				<p>加载中</p>
			</div>
		</div>
		<script src="<?php echo base_url() ?>public/app/js/mui.min.js"></script>
		<script src="<?php echo base_url() ?>public/app/js/function.js"></script>
		<script src="<?php echo base_url() ?>public/app/js/juicer.js"></script>
		<script src="<?php echo base_url() ?>public/app/js/storeInfo.js"></script>
	</body>
</html>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>
			我的订单
		</title>
		<link href="<?php echo base_url(); ?>public/app/css/mui.min.css" rel="stylesheet"/>
		<link href="<?php echo base_url(); ?>public/app/css/custom.css" rel="stylesheet"/>
	</head>
	<body>
		<!--<header class="mui-bar mui-bar-nav my-badge-green">
			<h1 class="mui-title">我的订单</h1>
			<a class="mui-btn mui-btn-link mui-btn-nav mui-pull-left" href="sergoodslist">
				<span class="mui-icon mui-icon-left-nav"></span>道客商城
			</a>
		</header>-->
		<div class="mui-content" id="order-list">
			<div id="store-goods-list">
				<div id="my-nav-box">
					<div class="mui-pull-left my-nav mui-col-xs-4 mui-active" data-type="0">
						全部
					</div>
					<div class="mui-pull-left my-nav mui-col-xs-4" data-type="1">
						待付款
					</div>
					<div class="mui-pull-left my-nav mui-col-xs-4" data-type="2">
						待消费
					</div>
					<!--<div class="mui-pull-left my-nav mui-col-xs-3" data-type="6">
						待评价
					</div>-->
				</div>
				<div id="pullrefresh" class="mui-scroll-wrapper">
					<div class="mui-scroll">
						<!--数据加载-->
						<div id="my-card" class="my-card">
							<ul id="goods-box" class="mui-table-view my-view-white">
							</ul>
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
		<script src="<?php echo base_url(); ?>public/app/js/mui.min.js"></script>
		<script src="<?php echo base_url(); ?>public/app/js/jquery.js"></script>
		<script src="<?php echo base_url(); ?>public/app/js/jquery.md5.js"></script>
		<script src="<?php echo base_url(); ?>public/app/js/juicer.js"></script>
		<script src="<?php echo base_url(); ?>public/app/js/function.js"></script>
		<script src="<?php echo base_url(); ?>public/app/js/getOrderList.js"></script>
	</body>
</html>

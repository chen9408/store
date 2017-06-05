<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>道客商城</title>
		<link href="<?php echo base_url(); ?>public/app/css/mui.min.css" rel="stylesheet" />
		<link href="<?php echo base_url(); ?>public/app/css/custom.css" rel="stylesheet" />
	</head>

	<body>
		<header class="mui-bar mui-bar-nav mui-badge-danger">
			<a href="getOrderList" class="mui-btn mui-btn-link mui-pull-left">我的订单</a>
			<!-- <h1 class="mui-title">线下服务</h1> -->
			<a id="city-name" href="location" class="mui-btn mui-btn-link mui-pull-right"></a>
			<input type="hidden" id="a-value" value="<?php echo $accountID; ?>" />
		</header>
		<div class="mui-content" id="goods-list">
			<div id="my-nav-box"></div>
			<div id="pullrefresh" class="mui-scroll-wrapper">
				<div class="mui-scroll">
					<!--数据加载-->
					<div class="my-card">
						<ul id="goods-box" class="mui-table-view my-view-white"></ul>
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
		<script src="<?php echo base_url(); ?>public/app/js/mui.js"></script>
		<script src="<?php echo base_url(); ?>public/app/js/juicer.js"></script>
		<script src="<?php echo base_url(); ?>public/app/js/function.js"></script>
		<script src="<?php echo base_url(); ?>public/app/js/sergoodslist.js"></script>
	</body>
</html>
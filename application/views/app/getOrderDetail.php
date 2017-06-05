<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>
			订单详情
		</title>
		<link href="<?php echo base_url(); ?>public/app/css/mui.min.css" rel="stylesheet"/>
		<link href="<?php echo base_url(); ?>public/app/css/custom.css" rel="stylesheet"/>
	</head>
	<body>
		<!--<header class="mui-bar mui-bar-nav my-badge-green">
			<h1 class="mui-title">订单详情</h1>
			<a class="mui-btn mui-btn-blue mui-btn-link mui-btn-nav mui-pull-left" href="getOrderList">
				<span class="mui-icon mui-icon-left-nav"></span>我的订单
			</a>-->
			<input type="hidden" id="orderID" value="<?php echo $orderID; ?>" />
		<!--</header>-->
		<div class="mui-content">
			<div id="order-detail"></div>
		</div>
		<script src="<?php echo base_url(); ?>public/app/js/mui.min.js"></script>
		<script src="<?php echo base_url(); ?>public/app/js/juicer.js"></script>
		<script src="<?php echo base_url(); ?>public/app/js/function.js"></script>
		<script src="<?php echo base_url(); ?>public/app/js/getOrderDetail.js?201507062313"></script>
	</body>
</html>

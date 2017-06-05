<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>提交支付</title>
    <link href="<?php echo base_url(); ?>public/app/css/mui.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>public/app/css/custom.css" rel="stylesheet"/>
</head>
<body>
	<header class="mui-bar mui-bar-nav my-badge-green">
		<!-- <h1 class="mui-title">提交支付</h1> -->
		<a href="getOrderList" class="mui-btn mui-btn-link mui-btn-nav mui-pull-left">
			<span class="mui-icon mui-icon-left-nav"></span>我的订单
		</a>
		<input type="hidden" id="orderID" value="<?php echo $orderID; ?>" />
	</header>
	<div class="mui-content">
		<div id="submit-payment">
		</div>
		<div class="my-box-padding my-fix-bottom padding-10">
			<a href="getOrderList" class="mui-btn my-badge-green exchange-btn">返回订单</a>
		</div>
	</div>
    <script src="<?php echo base_url(); ?>public/app/js/mui.min.js"></script>
    <script src="<?php echo base_url(); ?>public/app/js/juicer.js"></script>
    <script src="<?php echo base_url(); ?>public/app/js/function.js"></script>
	<script src="<?php echo base_url(); ?>public/app/js/submitPayment.js" type="text/javascript"></script>
</body>
</html>
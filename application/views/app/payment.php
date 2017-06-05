<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>确认支付</title>
    <link href="<?php echo base_url(); ?>public/app/css/mui.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>public/app/css/custom.css" rel="stylesheet"/>
</head>
<body>
	<header class="mui-bar mui-bar-nav mui-badge-danger">
		<!-- <h1 class="mui-title">确认支付</h1> -->
		<a id="goodsInfo" class="mui-btn mui-btn-blue mui-btn-link mui-btn-nav mui-pull-left">
			<span class="mui-icon mui-icon-left-nav"></span>商品详情
		</a>
		<input type="hidden" id="goodsID" value="<?php echo $goodsID; ?>" />
		<input type="hidden" id="orderID" value="<?php echo $orderID; ?>" />
	</header>
	<div class="mui-content">
		<div id="payment"></div>
		<div class="my-box-padding my-fix-bottom padding-10">
			<button id="exchange-btn" type="button" class="mui-btn mui-btn-danger exchange-btn">确认</button>
		</div>
	</div>
    <script src="<?php echo base_url(); ?>public/app/js/mui.min.js"></script>
    <script src="<?php echo base_url(); ?>public/app/js/juicer.js"></script>
    <script src="<?php echo base_url(); ?>public/app/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>public/app/js/jquery.md5.js"></script>
    <script src="<?php echo base_url(); ?>public/app/js/function.js"></script>
	<script src="<?php echo base_url(); ?>public/app/js/payment.js"></script>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>商品详情</title>
    <link href="<?php echo base_url(); ?>public/app/css/mui.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>public/app/css/custom.css" rel="stylesheet"/>
</head>
<body>
	<header class="mui-bar mui-bar-nav mui-badge-danger">
		<a class="mui-btn mui-btn-link mui-btn-nav mui-pull-left" href="sergoodslist">
			<span class="mui-icon mui-icon-left-nav"></span>商品列表
		</a>
		<!-- <h1 class="mui-title">商品详情</h1> -->
		<a class="mui-icon mui-icon-upload mui-pull-right"></a>
		<input type="hidden" id="goodsID" value="<?php echo $goodsID?>" />
	</header>
	<div class="mui-content">
		<div id="slider" class="mui-slider height-180">
			<div id="img-box" class="mui-slider-group mui-slider-loop"></div>
			<div class="mui-slider-indicator" id="select-box"></div>
		</div>
		<div id="goods-info"></div>
	</div>
	<nav class="mui-bar mui-bar-tab my-fix-bottom">
	    <div class="my-btn-box">
	        <button type="button" id="exchange-btn" class="mui-btn mui-btn-danger exchange-btn">立即兑换</button>
		</div>
	</nav>
    <script src="<?php echo base_url(); ?>public/app/js/mui.min.js"></script>
    <script src="<?php echo base_url(); ?>public/app/js/juicer.js"></script>
    <script src="<?php echo base_url(); ?>public/app/js/function.js"></script>
    <script src="<?php echo base_url(); ?>public/app/js/goodsInfo.js"></script>
</body>
</html>
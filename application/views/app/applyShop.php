<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>适用店铺</title>
    <link href="<?php echo base_url(); ?>public/app/css/mui.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>public/app/css/custom.css" rel="stylesheet"/>
</head>
<body>
	<header class="mui-bar mui-bar-nav mui-badge-danger" id="goods-info-btn">
		<!-- <h1 class="mui-title">适用店铺</h1> -->
		<a href="goodsInfo?goodsID=<?php echo $goodsID ?>" class="mui-btn mui-btn-link mui-btn-nav mui-pull-left">
			<span class="mui-icon mui-icon-left-nav"></span>商品详情
		</a>
		<input type="hidden" id="goodsID" value="<?php echo $goodsID ?>" />
	</header>
	<div class="mui-content" id="apply-shop">
	</div>
    <script src="<?php echo base_url(); ?>public/app/js/mui.min.js"></script>
    <script src="<?php echo base_url(); ?>public/app/js/function.js"></script>
    <script src="<?php echo base_url(); ?>public/app/js/juicer.js"></script>
		<script src="<?php echo base_url(); ?>public/app/js/applyShop.js"></script>
</body>
</html>
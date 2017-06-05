<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>选择城市</title>
		<link href="<?php echo base_url(); ?>public/app/css/mui.min.css" rel="stylesheet" />
		<link href="<?php echo base_url(); ?>public/app/css/custom.css" rel="stylesheet" />
	</head>

	<body>
		<header class="mui-bar mui-bar-nav mui-badge-danger">
			<!-- <h1 class="mui-title">选择城市</h1> -->
			<a class="mui-btn mui-btn-blue mui-btn-link mui-btn-nav mui-pull-left" href="sergoodslist">
				<span class="mui-icon mui-icon-left-nav"></span>线下服务
			</a>
		</header>
		<div class="mui-content">
			<div id="console"></div>
			<div id="location"></div>
		</div>
		<script src="<?php echo base_url(); ?>public/app/js/mui.js"></script>
		<script src="<?php echo base_url(); ?>public/app/js/juicer.js"></script>
		<script src="<?php echo base_url(); ?>public/app/js/function.js"></script>
		<script src="<?php echo base_url(); ?>public/app/js/location.js"></script>
	</body>

</html>
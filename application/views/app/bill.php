<!DOCTYPE html>
<html>
	
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>账单</title>
		<link href="<?php echo base_url(); ?>public/app/css/mui.min.css" rel="stylesheet" />
		<link href="<?php echo base_url(); ?>public/app/css/virtual.css?201507041616" rel="stylesheet" />
	</head>
	
	<body class="my-badge-ccc">
<!-- 		<header class="mui-bar mui-bar-nav index-nav-badge">
			<h1 class="mui-title my-text-white">账单</h1>
		</header> -->
		<div id="bill" class="mui-content">
			<input type="hidden" id="a-value" value="<?php echo $accountID; ?>" />
			<div class="mui-segmented-control">
				<a class="mui-control-item mui-active" href="#">我的账单</a>
				<a id="jump-getOrderList" class="mui-control-item" href="getOrderList">我的订单</a>
			</div>
			<div id="pullrefresh" class="mui-scroll-wrapper">
				<div class="mui-scroll">
					<!--数据加载-->
					<div id="my-card" class="my-card">
						<ul id="bill-list" class="bill-list">
						</ul>
					</div>
				</div>
			</div>
			<div id="bill-tips" class="hide">
				<p class="bill-tips-text">主人，你还没有账单噢，快用密点去消费吧~</p>
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
		<script src="<?php echo base_url(); ?>public/app/js/function.js"></script>
		<script src="<?php echo base_url(); ?>public/app/js/bill.js?201507041616"></script>
	</body>
</html>

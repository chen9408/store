<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>余额</title>
		<link href="<?php echo base_url(); ?>public/app/css/mui.min.css" rel="stylesheet" />
		<link href="<?php echo base_url(); ?>public/app/css/virtual.css" rel="stylesheet" />
	</head>

	<body class="my-badge-ccc">
<!-- 		<header class="mui-bar mui-bar-nav index-nav-badge">
			<h1 class="mui-title my-text-white">余额</h1>
		</header> -->
		<div id="balance" class="mui-content my-badge-ccc">
			<input type="hidden" id="a-value" value="<?php echo $accountID; ?>" />
			<div class="show-box mui-clearfix">
				<div id="mecoin-box" class="mecoin-box mui-col-xs-6 mui-pull-left">密点 -</div>
				<div id="wecoin-box" class="wecoin-box mui-col-xs-6 mui-pull-left">微点 -</div>
			</div>
			<div class="text-box">
				<p>微点:道客社区指定商户的货币,只可以在指定商户消费.指定商户消费时,可抵现1元.</p>
				<p>密点:道客社区通用的货币,可用于道客商城、购买保险、充值、提现、捐献、消费.消费时100密点可抵现1元.</p>
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
		<script src="<?php echo base_url(); ?>public/app/js/balance.js"></script>
	</body>

</html>
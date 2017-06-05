<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>充值</title>
		<link href="<?php echo base_url(); ?>public/app/css/mui.min.css" rel="stylesheet"/>
		<link href="<?php echo base_url(); ?>public/app/css/virtual.css" rel="stylesheet"/>
	</head>
	<body>
<!-- 		<header id="recharge-header" class="mui-bar mui-bar-nav">
			<h1 class="mui-title">话费充值</h1>
		</header> -->
		<div id="recharge" class="mui-content my-badge-white">
			<input type="hidden" id="a-value" value="<?php echo $accountID; ?>" />
			<p class="topic">
				话费充值可以将密点兑换成手机话费,具体兑换所需密点取决于您的充值面额和您的手气,祝您手气连连
			</p>
			<div class="color-bar my-badge-orange">
				<p id="moneyAmount" class="my-text-white">可兑换密点: - 密点</p>
			</div>
			<div class="margin-10-5">
				<div class="mui-input-row">
					<input class="gray-input" type="number" name="tel-number" id="tel-number" placeholder="请输入手机号码" />
				</div>
			</div>
			<div id="password-box" class="mui-table-view">
				<div class="mui-table-view-cell mui-media">
					<div class="mui-media-body">
						<div class="mui-input-row">
							<label>请输入密码:</label>
							<input id="password" type="password" class="mui-input-clear" placeholder="请输入密码">
						</div>
					</div>
				</div>
			</div>
			<div id="price-box" class="margin-10-5">
				<button class="price-button margin-r-2 cant-select" data-type="A100001549" data-value="10" disabled="true">
					10元
				</button>
				<button class="price-button margin-r-2 cant-select" data-type="A100002145" data-value="20" disabled="true">
					20元
				</button>
				<button class="price-button cant-select" data-type="A100003234" data-value="30" disabled="true">
					30元
				</button>
				<button class="price-button margin-r-2 cant-select" data-type="A100005487" data-value="50" disabled="true">
					50元
				</button>
				<button class="price-button margin-r-2 cant-select" data-type="A100001123" data-value="100" disabled="true">
					100元
				</button>
				<button class="price-button cant-select" data-type="A100003323" data-value="300" disabled="true">
					300元
				</button>
			</div>
			<div class="mui-clearfix margin-10-5">
				<div class="mui-pull-left">
					<span>库存量</span>
				</div>
				<div id="stock-amount" class="mui-pull-right text-strong my-text-orange">
				</div>
			</div>
			<div class="mui-clearfix margin-10-5">
				<div class="mui-pull-left">
					<span>归属地</span>
				</div>
				<div id="location" class="mui-pull-right text-strong my-text-orange">
				</div>
			</div>
			<div class="mui-clearfix margin-10-5">
				<div class="mui-pull-left">
					<span>所需密点</span>
				</div>
				<div id="need-mecoin" class="mui-pull-right text-strong my-text-orange">
				</div>
			</div>
			<div class="try-it">
				<button id="query-price" class="try-it-button" type="button">
					试试手气查价格
				</button>
			</div>
		</div>
		<div class="clearFoucs">
			<nav class="mui-bar mui-bar-tab my-fix-bottom">
				<div class="margin-10-5">
					<button id="immed-recharge" class="recharge-button" type="button" disabled="disabled">
						确认充值
					</button>
				</div>
			</nav>
		</div>
		<div id="shade"></div>
		<div id="onload">
			<div class="onload-box">
				<span class="mui-spinner"></span>
				<p>加载中</p>
			</div>
		</div>
		<script src="<?php echo base_url(); ?>public/app/js/mui.js"></script>
	  <script src="<?php echo base_url(); ?>public/app/js/jquery.js"></script>
	  <script src="<?php echo base_url(); ?>public/app/js/jquery.md5.js"></script>
		<script src="<?php echo base_url(); ?>public/app/js/function.js"></script>
		<script src="<?php echo base_url(); ?>public/app/js/phoneFee.js"></script>
	</body>
</html>

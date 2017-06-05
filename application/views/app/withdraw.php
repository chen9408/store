<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>提现</title>
    <link href="<?php echo base_url(); ?>public/app/css/mui.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>public/app/css/virtual.css" rel="stylesheet"/>
</head>
<body class="my-gray-badge">
	<div id="withdraw" class="mui-content">
		<input type="hidden" id="a-value" value="<?php echo $accountID; ?>" />
		<div class="mui-clearfix">
			<div class="color-bar my-badge-red margin-10-0"><p id="moneyAmount" class="my-text-white">可兑换密点: - 密点</p></div>
		</div>
		<div class="mui-clearfix">
			<p class="margin-ld-10">请选择提现的密点(100密点=1元)</p>
		</div>
		<div id="price-box" class="price-box mui-clearfix margin-0-10">
			<button class="price-button margin-r-2 cant-select" data-type="A100001630" data-value="10" disabled="true">
				10元
			</button>
			<button class="price-button margin-r-2 cant-select" data-type="A100008953" data-value="20" disabled="true">
				20元
			</button>
			<button class="price-button cant-select" data-type="A100004659" data-value="30" disabled="true">
				30元
			</button>
			<button class="price-button margin-r-2 cant-select" data-type="A100003453" data-value="50" disabled="true">
				50元
			</button>
			<button class="price-button margin-r-2 cant-select" data-type="A100008850" data-value="100" disabled="true">
				100元
			</button>
			<button class="price-button cant-select" data-type="A100008702" data-value="300" disabled="true">
				300元
			</button>
		</div>
		<div class="mui-clearfix my-badge-white padding-10-0 border-bottom-B6B6B6">
			<p class="margin-0-10 my-text-black"><span class="mui-pull-left">库存量:</span><span id="goods-count" class="mui-pull-right my-text-blue text-strong"></span></p>
		</div>
		<div class="mui-clearfix my-badge-white padding-10-0">
			<p class="margin-0-10 my-text-black"><span class="mui-pull-left">所需密点数:</span><span id="need-mecoin" class="mui-pull-right my-text-blue text-strong"></span></p>
		</div>
	</div>
	<nav class="mui-bar mui-bar-tab my-fix-bottom bottom-box">
		<div id="alipay-btn" class="mui-btn bottom-button">
			<p class="my-text-white text-strong font-size-12">立即提现到支付宝</p>
			<p class="my-text-white">(提现金额在7到15个工作日内到账)</p>
		</div>
		<div id="weixin-btn" class="mui-btn bottom-button">
			<p class="my-text-white text-strong font-size-12">立即提现到微信红包</p>
			<p class="my-text-white">(提现金额在5小时内到账)</p>
		</div>
	</nav>
	<div id="shade"></div>
	<div id="onload">
		<div class="onload-box">
			<span class="mui-spinner"></span>
			<p>加载中</p>
		</div>
	</div>
    <script src="<?php echo base_url(); ?>public/app/js/mui.min.js"></script>
	<script src="<?php echo base_url(); ?>public/app/js/function.js"></script>
	<script src="<?php echo base_url(); ?>public/app/js/withdraw.js"></script>
</body>
</html>

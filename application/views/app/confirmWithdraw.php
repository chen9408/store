<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>确认提现</title>
    <link href="<?php echo base_url(); ?>public/app/css/mui.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>public/app/css/virtual.css" rel="stylesheet"/>
</head>
<body>
	<div id="confirm" class="mui-content">
		<input id="goodsID" type="hidden" value="<?php echo $goodsID; ?>" />
		<div class="mui-input-row my-badge-white">
			<div class="mui-table-view-cell mui-media">
				<div class="mui-media-body">
					<div class="mui-input-row">
						<label class="font-size-8">支付宝账户:</label>
						<input id="alipay-account" class="save-mecoin mui-input-clear" type="text" placeholder="邮箱地址/手机号">
					</div>
				</div>
			</div>
		</div>
		<div id="password-box" class="mui-table-view hide">
			<div class="mui-table-view-cell mui-media">
				<div class="mui-media-body">
					<div class="mui-input-row">
						<label class="font-size-8">密码:</label>
						<input id="password" type="password" class="mui-input-clear" placeholder="请输入密码">
					</div>
				</div>
			</div>
		</div>
		<div id="name-box" class="mui-table-view margin-5-0 hide">
			<div class="mui-table-view-cell mui-media">
				<div class="mui-media-body">
					<div class="mui-input-row">
						<label>姓名:</label>
						<input id="fullName" class="mui-input-clear" type="text" placeholder="请输入姓名">
					</div>
				</div>
			</div>
		</div>
		<div id="idNumber-box" class="mui-table-view margin-5-0 hide">
			<div class="mui-table-view-cell mui-media">
				<div class="mui-media-body">
					<div class="mui-input-row">
						<label>身份证号码:</label>
						<input id="idNumber" class="mui-input-clear" type="text" placeholder="请输入身份证号码">
					</div>
				</div>
			</div>
		</div>
	</div>
	<nav class="mui-bar mui-bar-tab my-fix-bottom">
		<p class="mui-text-center margin-5-0">提现金额将在7到14个工作日内到账</p>
		<div class="margin-10-5">
			<button id="confirm-btn" class="confirm-button" type="button">
				确认充值
			</button>
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
    <script src="<?php echo base_url(); ?>public/app/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>public/app/js/jquery.md5.js"></script>
	<script src="<?php echo base_url(); ?>public/app/js/function.js?20150704"></script>
	<script src="<?php echo base_url(); ?>public/app/js/confirmWithdraw.js?201507062038"></script>
</body>
</html>

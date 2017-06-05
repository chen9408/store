<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>微信提现</title>
    <link href="<?php echo base_url(); ?>public/app/css/mui.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>public/app/css/virtual.css?201507061738" rel="stylesheet"/>
</head>
<body>
	<div id="weixin-withdraw" class="mui-content">
		<input id="goodsID" type="hidden" value="<?php echo $goodsID; ?>" />
		<div id="password-box" class="mui-table-view">
			<div class="mui-table-view-cell mui-media">
				<div class="mui-media-body">
					<div class="mui-input-row">
						<label class="font-size-8">密码:</label>
						<input id="password" type="password" class="mui-input-clear" placeholder="请输入密码" />
					</div>
				</div>
			</div>
		</div>
		<div id="name-box" class="mui-table-view margin-5-0 hide">
			<div class="mui-table-view-cell mui-media">
				<div class="mui-media-body">
					<div class="mui-input-row">
						<label>姓名:</label>
						<input id="fullName" class="mui-input-clear" type="text" placeholder="请输入姓名" />
					</div>
				</div>
			</div>
		</div>
		<div id="idNumber-box" class="mui-table-view margin-5-0 hide">
			<div class="mui-table-view-cell mui-media">
				<div class="mui-media-body">
					<div class="mui-input-row">
						<label>身份证号码:</label>
						<input id="idNumber" class="mui-input-clear" type="text" placeholder="请输入身份证号码" />
					</div>
				</div>
			</div>
		</div>
		<div id="code-box" class="mui-table-view margin-5-0 hide">
			<div class="mui-table-view-cell mui-media">
				<div class="mui-media-body">
					<div class="mui-input-row">
						<h5>微信红包兑换码:</h5>
						<textarea readonly="readonly" id="code"></textarea>
					</div>
				</div>
			</div>
		</div>
	  <p>关于兑换码:</p>
	  <p>1.请关注我们的微信公众号【语镜汽车道客服务区】</p>
	  <p>2.<span class="mui-badge mui-badge-danger">长按</span>兑换码显示框内的文字复制该页面的兑换码。</p>
	  <p>3.进入到微信公众号上点击【红包兑换】跳转到兑换页面,粘贴该兑换码即可提现到微信钱包。</p>
	</div>
	<nav id="confirm-box" class="mui-bar mui-bar-tab my-fix-bottom">
		<p class="mui-text-center margin-5-0">提现金额将在5小时内到账</p>
		<div class="margin-10-5">
			<button id="confirm-btn" class="confirm-button" type="button">确认充值</button>
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
	<script src="<?php echo base_url(); ?>public/app/js/weixinWithdraw.js?201507062037"></script>
</body>
</html>

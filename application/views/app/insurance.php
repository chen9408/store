<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>保险预购金</title>
    <link href="<?php echo base_url(); ?>public/app/css/mui.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>public/app/css/virtual.css" rel="stylesheet"/>
</head>
<body>
	<div class="mui-content">
		<input type="hidden" id="a-value" value="<?php echo $accountID; ?>" />
		<div class="mui-badge-danger">
			<p class="padding-5-0 mui-text-center my-text-white">已存入的保险预购金(元)</p>
			<p id="deposit" class="mui-text-center my-text-white">-</p>
		</div>
		<div class="mui-input-row my-badge-white border-bottom-B6B6B6">
			<label class="long">车险预购金存入补贴(元):</label>
			<p id="subsidy">-</p>
		</div>
		<div class="mui-input-row my-badge-white">
			<label class="long">购&nbsp;&nbsp;&nbsp;车&nbsp;&nbsp;&nbsp;险&nbsp;&nbsp;&nbsp;可&nbsp;&nbsp;&nbsp;返(元):</label>
			<p id="ableBack">-</p>
		</div>
		<p class="font-size-6 margin-5-0 mui-text-center">单笔存入密点数每满1000可获补贴1元现金</p>
		<div class="white-bar"><p id="moneyAmount" class="my-text-danger">可兑换密点: - 密点</div>
		<div class="mui-input-row my-badge-white">
			<label id="label-mecoin">本次存入密点:</label>
			<input id="input-mecoin" class="save-mecoin mui-input-clear" type="text" style="width: 60%;" placeholder="请输入要存入的数量">
		</div>
		<div id="password-box" class="mui-table-view margin-5-0 ">
			<div class="mui-table-view-cell mui-media">
				<div class="mui-media-body">
					<div class="mui-input-row">
						<label>请输入密码:</label>
						<input id="password" type="password" class="mui-input-clear" placeholder="请输入密码">
					</div>
				</div>
			</div>
		</div>
		<p class="margin-5-0 mui-text-center">起存金额:100密点,以100密点递增</p>
		<p class="margin-5-0 mui-text-right">兑换比例:100密点=1元保险预购金</p>
		<div class="margin-10-50">
			<button class="mui-btn" id="save-btn">马上存入</button>
		</div>
		<!-- <p class="mui-text-center padding-5-0"><a class="my-text-danger test-car" href="">测试一下自己的爱车值多少钱</a></p> -->
		<div class="my-badge-white">
			<p class="my-text-black text-strong font-size-8">什么是保险预购金?</p>
			<p class="my-text-black bill-qa">保险预购金是将每月的奖金存入预购金账户,当在道客社区成功购买车险,可以获得保险预购金中的所有现金.</p>
			<p class="my-text-black text-strong font-size-8">存入有什么好处?</p>
			<p class="my-text-black bill-qa">积少成多，每月存入金额满1000密点.道客社区将补贴1元。未来还可以获得保险公司提供的车险补贴。</p>
			<p class="my-text-black text-strong font-size-8">预购金除了买车还能干什么?</p>
			<p class="my-text-black bill-qa">暂时只能用于购买车险,未来我们将开放驾驶意外险、高温险、拍照丢失险等其他新型的保险。</p>
			<p class="my-text-black text-strong font-size-8">道客社区的车险会比其他平台贵吗?</p>
			<p class="my-text-black bill-qa">道客社区提供的车险和其他平台一样，最高可优惠15%，加上补贴的预购金会更加优惠。</p>
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
  <script src="<?php echo base_url(); ?>public/app/js/jquery.js"></script>
  <script src="<?php echo base_url(); ?>public/app/js/jquery.md5.js"></script>
	<script src="<?php echo base_url(); ?>public/app/js/function.js"></script>
	<script src="<?php echo base_url(); ?>public/app/js/insurance.js"></script>
</body>
</html>
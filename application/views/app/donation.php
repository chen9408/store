<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>捐献社区</title>
    <link href="<?php echo base_url(); ?>public/app/css/mui.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>public/app/css/virtual.css" rel="stylesheet"/>
</head>
<body class="my-gray-badge">
	<div id="donation" class="mui-content">
		<input type="hidden" id="a-value" value="<?php echo $accountID; ?>" />
		<p class="topic">道客快分享社区致力于让大家在路上走得更快、走得更快乐。</p>
		<p class="topic">社区的快速发展离不开大家的支持,您可以将自己的奖金密点捐献给社区建设。</p>
		<div class="color-bar my-badge-white"><p id="moneyAmount" class="my-text-blue">可兑换密点: - 密点</p></div>
		<div class="margin-10-0">
			<div class="mui-input-row">
				<input class="input-mecoin mui-input-clear" type="text" id="input-mecoin" placeholder="请输入你要贡献的密点数" />
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
		<button id="donation-btn" class="mui-btn donation-btn">确认捐献</button>
		<p class="devote-list">贡献榜</p>
		<div class="mui-clearfix">
			<div class="mui-pull-left mui-col-xs-4">
				<p class="mui-text-center my-ranking">我的排行</p>
			</div>
			<div class="mui-pull-left mui-col-xs-8">
				<p id="donation-mecoin" class="mui-text-center ranking-content">本日已捐献-密点</p>
				<p id="ranking" class="mui-text-center">本日排名第-名</p>
			</div>
		</div>
		<div id="my-nav-box" class="my-nav-box mui-clearfix">
			<div class="my-nav mui-col-xs-4 mui-active" data-type="1">
				今日榜单
			</div>
			<div class="my-nav mui-col-xs-4" data-type="2">
				本周榜单
			</div>
			<div class="my-nav mui-col-xs-4" data-type="3">
				本月榜单
			</div>
		</div>
		<div id="donation-scroll" class="mui-scroll">
			<!--数据加载-->
			<ul id="donation-box" class="mui-table-view">
			</ul>
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
	<script src="<?php echo base_url(); ?>public/app/js/donation.js"></script>
</body>
</html>
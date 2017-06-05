<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>顾客评价</title>
    <link href="<?php echo base_url(); ?>public/app/css/mui.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>public/app/css/custom.css" rel="stylesheet"/>
</head>
<body>
	<header class="mui-bar mui-bar-nav my-badge-green">
		<!-- <h1 class="mui-title">顾客评价</h1> -->
		<button class="mui-btn mui-btn-link mui-btn-nav mui-pull-left mui-action-back">
			<span class="mui-icon mui-icon-left-nav"></span>返回
		</button>
		<input type="hidden" id="goodsID" value="<?php echo $goodsID ?>" />
	</header>
	<div class="mui-content" id="goods-comment">
		<div id="my-nav-box"></div>
		<div id="pullrefresh" class="mui-scroll-wrapper">
			<div class="mui-scroll">
				<!--数据加载-->
				<div id="my-card" class="my-card">
					<ul id="goods-box" class="mui-table-view"></ul>
				</div>
			</div>
		</div>
	</div>
	<div id="img-layer">
		<div id="img-box" class="img-box">
			<img id="big-img" class="big-img" src=""/>
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
  <script src="<?php echo base_url(); ?>public/app/js/juicer.js"></script>
	<script src="<?php echo base_url(); ?>public/app/js/goodsComment.js"></script>
</body>
</html>
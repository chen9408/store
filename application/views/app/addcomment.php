<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>我的评价</title>
    <link href="<?php echo base_url(); ?>public/app/css/mui.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>public/app/css/custom.css" rel="stylesheet"/>
</head>
<body>
	<header class="mui-bar mui-bar-nav my-badge-green">
		<!-- <h1 class="mui-title">我的评价</h1> -->
		<a class="mui-btn mui-btn-link mui-btn-nav mui-pull-left" href="getOrderList?accountID=kxl1QuHKCD">
			<span class="mui-icon mui-icon-left-nav"></span>我的订单
		</a>
		<input type="hidden" id="orderID" value="<?php echo $orderID ?>" />
	</header>
	<div class="mui-content">
		<div id="add-comment">
			<div id="order-box" class="mui-table-view margin-t-5">
			</div>
			<div id="comment-box" class="mui-table-view margin-t-5">
			</div>
			<div class="mui-table-view margin-t-5 padding-5-0">
				<div id="eval-panel" class="mui-input-row margin-10-5">
					<div class="textTitle mui-pull-left font-size-1 padding-t-20">评分:</div>
					<form id="input-list-box" class="margin-l-40">
						<div class="my-input-list">
							<label>满意</label>
							<div class="mui-clearfix"></div>
							<input class="radio" name="comment" type="radio" value="3">
						</div>
						<div class="my-input-list">
							<label>一般</label>
							<div class="mui-clearfix"></div>
							<input class="radio" name="comment" type="radio" value="2">
						</div>
						<div class="my-input-list">
							<label>失望</label>
							<div class="mui-clearfix"></div>
							<input class="radio" name="comment" type="radio" value="1">
						</div>
					</form>
				</div>
				<div id="comment-panel" class="margin-10-5">
					<div class="textTitle mui-pull-left font-size-1">吐槽:</div>
					<div class="margin-l-40">
						<textarea id="textarea" rows="5"></textarea>
					</div>
				</div>
				<div id="picture-panel" class="mui-input-row margin-10-5">
					<div class="margin-l-40">
						<div class="img-box">
							<img class="showImg" name="showImg" src="" alt="" />
							<img class="showImg" name="showImg" src="" alt="" />
							<img class="showImg" name="showImg" src="" alt="" />
						</div>
						<div class="mui-clearfix"></div>
						<button type="button" id="add-img" class="mui-btn mui-btn-success add-img">添加图片</button>
						<input class="commentImg" type="file" name="commentImg" />
						<input class="commentImg" type="file" name="commentImg" />
						<input class="commentImg" type="file" name="commentImg" />
					</div>
				</div>
				<button type="button" class="mui-btn my-badge-green exchange-btn" id="add-comment-btn">提交</button>
			</div>
		</div>
	</div>
	<div id="img-layer">
		<div id="img-box" class="img-box">
			<img id="big-img" class="big-img" src=""/>
		</div>
	</div>
    <script src="<?php echo base_url(); ?>public/app/js/mui.min.js"></script>
    <script src="<?php echo base_url(); ?>public/app/js/function.js"></script>
    <script src="<?php echo base_url(); ?>public/app/js/juicer.js"></script>
	<script src="<?php echo base_url(); ?>public/app/js/addcomment.js"></script>
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0069)http://www.17sucai.com/preview/222076/2015-05-28/turnplate/index.html -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
	<title>大转盘活动</title>

	<link href="<?php echo base_url(); ?>public/app/css/style.css?3" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>public/app/css/bootstrap.min.css?3" rel="stylesheet" type="text/css">
</head>
<body style="overflow-x: hidden; background: rgb(230, 45, 45);">
	<!--<img src="images/1.png" id="shan-img" style="display:none;">
	<img src="images/2.png" id="sorry-img" style="display:none;">
	-->
	<input id="accountID" type="hidden" value="<?php echo $accountID ?>
	" />
	<div class="banner">
		<div class="turnplate" style="background-image:url(<?php echo base_url(); ?>public/app/images/turnplate-bg.png);background-size:100% 100%;">
			<canvas style="position:relative; z-index:95;" class="item" id="wheelcanvas" width="422px" height="422px" style="-webkit-transform: rotate(92.3deg);"></canvas>
			<img style="z-index:99;" class="pointer" src="<?php echo base_url(); ?>public/app/images/turnplate-pointer.png"></div>
	</div>
	<p class="copyright">本活动的最终解释权归上海语镜汽车信息技术公司有限所有。</p>
	<div id="shade" class="my-hide"></div>
	<div id="tip-bg" class="my-hide">
		<div class="tips-case">
			<h3 id="tip-title"></h3>
			<p id="tip-content"></p>
			<div class="my-row">
				<input class="btn btn-primary" type="button" id="confirm-btn" value="确认">
				<input class="btn btn-danger" type="button" id="cancel-btn" value="取消"></div>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/app/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/app/js/jquery.confirm.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/app/js/awardRotate.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/app/js/lottery.js?127"></script>

</body>
</html>
<!DOCTYPE html>
<html style="background: #EFEFEF">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>道客账户</title>
		<link href="<?php echo base_url(); ?>public/app/css/mui.min.css" rel="stylesheet"/>
		<link href="<?php echo base_url(); ?>public/app/css/virtual.css" rel="stylesheet"/>
	</head>

	<body>
		<header class="mui-bar mui-bar-nav index-nav-badge">
			<!-- <h1 class="mui-title my-text-white">道客账户</h1> -->
			<input type="hidden" id="a-value" value="<?php echo $accountID; ?>" />
		</header>
		<div id="index" class="mui-content">
			<div id="account"></div>
			<div class="up-nav">
				<a class="mui-pull-left" href="balance">余额</a>
				<a class="mui-pull-right" href="bill">账单</a>
			</div>
			<ul class="mui-table-view mui-grid-view mui-grid-9" style="background: #FEFEFE;">
				<li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">
					<a href="sergoodslist">
						<div class="mui-media-body">商城</div>
					</a>
				</li>
				<li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">
					<a href="#">
						<div class="mui-media-body">购买车险</div>
					</a>
				</li>
				<li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">
					<a href="insurance">
						<div class="mui-media-body">保险预购金</div>
					</a>
				</li>
				<li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">
					<a href="donation">
						<div class="mui-media-body">捐献社区</div>
					</a>
				</li>
				<li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">
					<a href="phoneFee">
						<div class="mui-media-body">充值</div>
					</a>
				</li>
				<li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">
					<a href="withdraw">
						<div class="mui-media-body">提现</div>
					</a>
				</li>
			</ul>
		</div>
		<script src="<?php echo base_url(); ?>public/app/js/mui.js"></script>
		<script src="<?php echo base_url(); ?>public/app/js/function.js"></script>
		<script type="text/javascript">
		(function(){
			//本页面的命名空间
			my_var.index = {};
			//为本页面的命名空间取别名
			var _$ = my_var.index;
			//判断访问时是否带有accountID,如有就保存本地sessionStorage
			_$.aValue = my_var.getById('a-value').value||null;
			if(_$.aValue){
				sessionStorage.setItem('a-value',_$.aValue);
				//判断结束
			}
			document.getElementById('account').innerHTML = window.location.href;
		}())
		</script>
	</body>

</html>
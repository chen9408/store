<p class="uk-text-large uk-text-muted">商品管理&ndash;审核新商品</p>
<div class="uk-width-medium-1-1">
	<div class="uk-width-medium-9-10 goods-medium">
	 	<ul class="uk-tab uk-active" data-uk-tab="{connect:'#tab-content'}">
	        <li class="uk-active"><a href="#">商品介绍</a></li>
	        <li class=""><a href="#">订单列表</a></li>
	        <li class=""><a href="#">商品评价</a></li>
	    </ul>
	   	<div id="tab-content"class="uk-switcher uk-margin">
			<div class="uk-width-medium-1-1 goods-list" id="goodsIntroduce">
				<dl class="uk-description-list-horizontal">
			    <dt>商品状态：</dt>
			    <dd>{goodsStatus}</dd>
			</dl><dl class="uk-description-list-horizontal">
			    <dt>商品编号：</dt>
			    <dd id="goodsID">{goodsID}</dd>
			</dl><dl class="uk-description-list-horizontal">
			    <dt>是否支持微点：</dt>
			    <dd>{supportWecoin}</dd>
			</dl><dl class="uk-description-list-horizontal">
			    <dt>商品类型：</dt>
			    <dd id="goodsSubType">{goodsSubType}</dd>
			</dl><dl class="uk-description-list-horizontal">
			    <dt>商品名称：</dt>
			    <dd>{goodsName}</dd>
			</dl><dl class="uk-description-list-horizontal">
			    <dt>商品副标题：</dt>
			    <dd>{subtitle}</dd>
			</dl><dl class="uk-description-list-horizontal">
			    <dt>商品关键字：</dt>
			    <dd>{keywords}</dd>
			</dl><dl class="uk-description-list-horizontal">
			    <dt>商品库存数量：</dt>
			    <dd>{goodsCount}</dd>
			</dl><dl class="uk-description-list-horizontal">
			    <dt>开始销售时间：</dt>
			    <dd>{startTime}</dd>
			</dl><dl class="uk-description-list-horizontal">
			    <dt>结束销售时间：</dt>
			    <dd>{endTime}</dd>
			</dl><dl class="uk-description-list-horizontal">
			 	<dt>商品实际图片：</dt>
			    <dd><a href="#goodsImg" data-uk-modal><img src="{goodsImg}" class="goods-small-img"/></a></dd>
			    <div id="goodsImg" class="uk-modal">
			    	<div class="uk-modal-dialog uk-modal-dialog-frameless">
			    		<a href="" class="uk-modal-close uk-close uk-close-alt"></a><img src="{goodsImg}" alt="">
			    	</div>
			    </div>
			</dl><dl class="uk-description-list-horizontal">
			 	<dt>商品缩略图：</dt>
			    <dd><a href="#goodsThumb" data-uk-modal><img src="{goodsThumb}" class="goods-small-img"/></a></dd>
			    <div id="goodsThumb" class="uk-modal">
			    	<div class="uk-modal-dialog uk-modal-dialog-frameless">
			    		<a href="" class="uk-modal-close uk-close uk-close-alt"></a><img src="{goodsThumb}" alt="">
			    	</div>
			    </div>
			</dl><dl class="uk-description-list-horizontal">
			    <dt>市场售价：</dt>
			    <dd>{marketPrice}</dd>
			</dl><dl class="uk-description-list-horizontal">
			    <dt>本店售价：</dt>
			    <dd>{shopPrice}</dd>
			</dl><dl class="uk-description-list-horizontal">
			    <dt>商家编号：</dt>
			    <dd><a href="#sellerInfoMain" data-uk-modal id="getSellerInfo">{sellerID}</a></dd>
			    <div id="sellerInfoMain" class="uk-modal">
			    	<div class="uk-modal-dialog uk-modal-dialog-frameless">
			    		<a href="" class="uk-modal-close uk-close uk-close-alt"></a>
			    		<p>商家详细信息：</p>
			    		<div id="sellerModal"></div>
			    	</div>
			    </div>
			</dl><dl class="uk-description-list-horizontal">
			    <dt>销售店铺：</dt>
			    {shopInfo}<dd>【{shopName}】地址：{address} &brvbar; 联系人：{manager} &brvbar; 电话：{telephone}</dd>{/shopInfo}
			</dl><dl class="uk-description-list-horizontal">
			    <dt>商品点击数：</dt>
			    <dd>{clickCount}</dd>
			</dl><dl class="uk-description-list-horizontal">
			    <dt>商品简要描述：</dt>
			    <dd>{brief}</dd>
			</dl><dl class="uk-description-list-horizontal">
			    <dt>商品详细描述：</dt>
			    <dd>{details}</dd>
			</dl>
		   </div>
		   <div class="uk-width-medium-1-1 goods-list" id="goodsOrderList">( ⊙o⊙ )</div>
		   <div class="uk-width-medium-1-1 goods-list" id="goodsEvaluate">( ⊙o⊙ )</div>
	   	</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>public/js/juicer-min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/store-admin.js"></script>

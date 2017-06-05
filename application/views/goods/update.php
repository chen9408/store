<p class="uk-text-large uk-text-muted">商品管理&ndash;商品详情</p>
<div class="uk-grid">
	<div class="uk-width-medium-1-1">
		<div class="uk-width-medium-3-5 goods-medium">
		 	<ul class="uk-tab uk-active" data-uk-tab="{connect:'#tab-content'}">
		        <li class="uk-active"><a href="#">商品介绍</a></li>
		        <li class=""><a href="#">订单列表</a></li>
		        <li class=""><a href="#">商品评价</a></li>
		    </ul>
		   	<div id="tab-content"class="uk-switcher uk-margin">
   				<div class="uk-width-medium-1-1 uk-grid goods-list" id="goodsIntroduce">
   					<div class="uk-width-medium-1-4">
   						<div class="jqzoom" data="<?php echo $goods_details["goodsImg"];?>" id="goodsImgZoom" >
				            <img src="<?php echo $goods_details["goodsImg"];?>"/>
   						</div>
                    	<div class="goods-img-nav">
                    		<ul class="goods-img-list uk-dotnav">
                    			<li class="goods-img-zoom img-active"><img src="<?php echo $goods_details["goodsImg"];?>" alt="" data-uk-tooltip="{pos:'bottom'}" title="商品实际图片" data-cached-title></li>
                    			<li class="goods-img-zoom"><img src="<?php echo $goods_details["goodsThumb"];?>" alt="" data-uk-tooltip="{pos:'bottom'}" title="商品缩略图片" data-cached-title></li>
                    		</ul>
                    	</div>
                	</div>
   					<div class="uk-active uk-width-medium-3-4 goods-form">
	    			<?php echo form_open('goods/update', $attributes);?>
	    				<input type="hidden" name="goodsID" value="<?php echo $goods_details["goodsID"];?>" id="goodsID"/>
	    				<input type="hidden" id="goodsSubTypeHide" value="<?php echo $goods_details["goodsSubType"];?>"/>
	                    <input type="hidden" name="details" value="">
	    				<div class="uk-form-row">
		    				<label class="uk-form-label" for="goodsName"><span class="uk-text-danger">*</span>商品类型：</label>
		                    <div class="form-input">
		                        <select id="goodsType">
		                        	<option value="B">服务商品</option>
		                        	<option value="C">实物商品</option>
		                        	<!-- <option value="D">保险商品</option>
		                        	<option value="A">虚拟商品</option> -->
		                        </select>
		                        <select name="goodsSubType" id="goodsSubType"></select>
		                    </div>
		                </div>
		                <div class="uk-form-row">
		                    <label class="uk-form-label" for="goodsName"><span class="uk-text-danger">*</span>商品名称：</label>
		                    <div class="form-input">
		                        <input type="text" class="uk-form-width-medium goodsName" name="goodsName" data-uk-tooltip="{pos:'left'}" title="" data-cached-title=""  placeholder="商品名称" value="<?php echo $goods_details["goodsName"];?>" required />
		                        <span class="uk-text-danger"><?php echo form_error('goodsName', '<em>', '</em>'); ?></span>
		                    </div>
		                </div>                
		                <div class="uk-form-row">
		                    <label class="uk-form-label" for="subtitle"><span class="uk-text-danger">*</span>商品副标题：</label>
		                    <div class="form-input">
		                        <input type="text" class="uk-form-width-medium subtitle" name="subtitle" data-uk-tooltip="{pos:'left'}" title="" data-cached-title=""  placeholder="商品副标题" value="<?php echo $goods_details["subtitle"];?>" required />
		                        <span class="uk-text-danger"><?php echo form_error('subtitle', '<em>', '</em>'); ?></span>
		                    </div>
		                </div>
		                <div class="uk-form-row">
		                    <label class="uk-form-label" for="keywords"><span class="uk-text-danger">*</span>商品关键字：</label>
		                    <div class="form-input">
		                        <input type="text" class="uk-form-width-medium keywords" name="keywords" data-uk-tooltip="{pos:'left'}" title="商品关键字, 放在商品页的关键字中, 为搜索引擎收录用.多个关键字之间用英文的逗号进行分隔" data-cached-title placeholder="商品关键字" value="<?php echo $goods_details["keywords"];?>" required />
		                        <span class="uk-text-danger"><?php echo form_error('keywords', '<em>', '</em>'); ?></span>
		                    </div>
		                </div>
		                <div class="uk-form-row">
		                    <label class="uk-form-label" for="goodsCount"><span class="uk-text-danger">*</span>库存数量：</label>
		                    <div class="form-input">
		                        <input type="text" class="uk-form-width-small goodsCount" maxlength="6" name="goodsCount" data-uk-tooltip="{pos:'left'}" title="大于0的整数" data-cached-title placeholder="商品库存数量" value="<?php echo $goods_details["goodsCount"];?>" required />
		                        <span class="uk-text-danger"><?php echo form_error('goodsCount', '<em>', '</em>'); ?></span>
		                    </div>
		                </div>
		                <div class="uk-form-row">
		                    <label class="uk-form-label" for="shopPrice"><span class="uk-text-danger">*</span>商品售价：</label>
		                    <div class="uk-form-icon">
							    <i class="uk-icon-cny"></i>
						     	<input type="text" class="uk-form-width-small shopPrice" name="shopPrice" data-uk-tooltip="{pos:'right'}" title="单位：密点，1密点=1分钱" data-cached-title placeholder="本店售价" value="<?php echo $goods_details["shopPrice"]; ?>" required />
		                        <span class="uk-text-danger"><?php echo form_error('shopPrice', '<em>', '</em>'); ?></span>
		                        <i class="uk-icon-cny"></i>
		                        <input type="text" class="uk-form-width-small marketPrice" name="marketPrice" data-uk-tooltip="{pos:'right'}" title="单位为人民币元" data-cached-title value="<?php echo $goods_details["marketPrice"]; ?>" placeholder="市场售价" />
		                        <span class="uk-text-danger"><?php echo form_error('marketPrice', '<em>', '</em>'); ?></span> 
							</div>
		                </div>           
		                <div class="uk-form-row">
		                    <label class="uk-form-label" for="goodsImg"><span class="uk-text-danger">*</span>商品图片：</label>
		                   	<ul class="uk-list add-img-list">
		                   		<li data-uk-tooltip="{pos:'top'}" title="商品实际图片,最大支持 2MB" data-cached-title>
		                   			<a href="javascript:;" id="goodsImg" class="add-img jqzoom" style="display:none;"></a>
		                   			<a class="uk-form-file " href="javascript:;">更换 <input class="imgUpload" name="goodsImg" data="goodsImg" type="file" accept="image/*" require/></a>
		                   		</li>
		                   		<li data-uk-tooltip="{pos:'top'}" title="商品缩略图片,最大支持 2MB" data-cached-title>
		                   			<a href="javascript:;" id="goodsThumb" class="add-img jqzoom" style="display:none;"></a>
		                   			<a class="uk-form-file" href="javascript:;">更换 <input class="imgUpload" name="goodsThumb" data="goodsThumb" type="file" accept="image/*" require /></a>
		                   		</li>     
		                   	</ul>
		                   	<span class="uk-text-danger" id="imgUploadError"></span>
		                </div>
	                	<div class="uk-form-row">
		            		<input type="hidden" name="shopID" id="shopHidden" value="<?php echo $goods_details["shopID"];?>" />
		                    <label class="uk-form-label" for="details"><span class="uk-text-danger">*</span>选择店铺：</label>
		                    <div class="shop-list" id="shopList"></div>
		                </div>
		                <div class="uk-form-row">
		                	<label class="uk-form-label" for="getAging"><span class="uk-text-danger">*</span>到店领取时间：</label>
		                	<div class="form-input">
		                		<input type="text" class="uk-form-width-medium getAging" name="getAging" data-uk-tooltip="{pos:'right'}" title="规定天数内领取，过期无效" data-cached-title placeholder="输入正整数的天数" value="<?php echo $goods_details["getAging"]; ?>" required />
		                	</div>
		                </div>		               
		                <div class="uk-form-row" id="supportWecoin">
		                    <label class="uk-form-label" for="supportWecoin"><span class="uk-text-danger">*</span>是否支持微点：</label>
		                    <div class="form-input">
		                    	<label><input type="radio" name="supportWecoin" <?php if($goods_details["supportWecoin"] ==1){echo "checked";}?> value="1"> 是</label>
		                    	<label><input type="radio" name="supportWecoin" <?php if($goods_details["supportWecoin"] ==0){echo "checked";}?> value="0"> 否</label>
		                    </div>
		                </div>
		                <div class="uk-form-row">
		                	<label class="uk-form-label" for="startTime"><span class="uk-text-danger">*</span>销售日期：</label>
		                	 <div class="uk-form-icon">
	    						<i class="uk-icon-calendar"></i>
		                	 	<input type="text" name="startTime" class="uk-form-width-small" data-uk-datepicker="{format:'YYYY-MM-DD'}" placeholder="开始时间" value="<?php echo $goods_details["startTime"];?>" required />
		                	 	&ndash;
		                	 	<i class="uk-icon-calendar"></i>
		                	 	<input type="text" name="endTime" class="uk-form-width-small" data-uk-datepicker="{format:'YYYY-MM-DD'}"  placeholder="结束时间" value="<?php echo $goods_details["endTime"];?>" required />
		                	 	<span class="uk-text-danger"><?php echo form_error('startTime', '<em>', '</em>'); ?></span>
		                	 </div>
		                </div>
		                <div class="uk-form-row">
		                    <label class="uk-form-label" for="brief">&nbsp;商品简要描述：</label>
		                    <div class="form-input">
		                        <textarea cols="40" rows="3" data-uk-tooltip="{pos:'right'}" title="" data-cached-title placeholder="" name="brief" class="brief"><?php echo $goods_details["brief"];?></textarea>
		                    </div>
		                </div>
		              	<div class="uk-form-row">
		                    <label><span class="uk-text-danger">*</span>商品详细描述：</label>
    	                	<script id="editor" type="text/plain" class="uk-width-1-1 ueditor"></script>
	                	</div>
		                <div class="uk-form-row">
		                    <label class="uk-form-label" for="details">&nbsp;备注：</label>
		                    <div class="form-input">
		                        <textarea cols="40" rows="3" data-uk-tooltip="{pos:'left'}" title="" data-cached-title placeholder="商品的商家备注,仅商家可见" name="remark" class="remark"><?php echo $goods_details["remark"]; ?></textarea>
		                    </div>
		                </div>
		                <hr />
		                <div class="uk-form-row form-button">
			                <button class="uk-button uk-button-large uk-button-primary addGoods" type="submit">保存修改</button>
	                    </div>
	            	</form>
	    		</div>
	    		</div>
   			   <div class="uk-width-medium-1-1 goods-list" id="goodsOrderList">( ⊙o⊙ )</div>
   			   <div class="uk-width-medium-1-1 goods-list" id="goodsEvaluate">( ⊙o⊙ )</div>
		   	</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>public/js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/additional-method.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/jquery.metadata.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/juicer-min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/store-goods.js"></script>
<script type="text/javascript">
	var ue = UE.getEditor('editor');
	setTimeout(function (){
		UE.getEditor('editor').execCommand('insertHtml','<?php echo $goods_details["details"]; ?>');
	},1000);
</script>
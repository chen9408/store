<p class="uk-text-large uk-text-muted">商品管理&ndash;添加新商品</p>
<div class="uk-width-medium-1-1">
	<div class="uk-width-medium-1-2 goods-medium">
		<?php echo form_open('goods/add', $attributes);?>
        <input type="hidden" name="details" value="">
		<div class="uk-panel uk-panel-box">
			<div class="uk-grid">
				<div class="uk-width-1-6">
	                <h2 class="uk-h3">基本信息</h2>                 	
	            </div>
	            <div class="uk-width-5-6">
	            	<div class="uk-form-row">
	                    <label class="uk-form-label" for="goodsName"><span class="uk-text-danger">*</span>商品类型：</label>
	                    <div class="form-input">
	                        <select name="goodsType" id="goodsType">
	                        	<option value="B">服务商品</option>
	                        	<!-- <option value="D">保险商品</option>
	                        	<option value="A">虚拟商品</option> -->
	                        </select>
	                        <select name="goodsSubType" id="goodsSubType"></select>
	                    </div> 
	                    <ul class="uk-list uk-text-muted">		                	
		                	<li>服务商品：需要在线下门店消费的，洗车、打蜡、保养、换胎等。</li>
		                	<li>实物商品：不支持邮寄、快递，仅支持门店领取的实际物体。</li>
		                	<!-- <li>保险商品：如电子车险、卡单式保险等。</li>
		                	<li>虚拟商品：即只是电子订单，如：充值卡密，其他虚拟货币。</li> -->
		                </ul>
		                <div class="uk-form-row" id="supportWecoin">
		                    <label class="uk-form-label" for="supportWecoin"><span class="uk-text-danger">*</span>是否支持微点：</label>
		                    <div class="form-input">
		                    	<label><input type="radio" name="supportWecoin" checked value="1"> 是</label>
		                    	<label><input type="radio" name="supportWecoin" value="0"> 否</label>
		                    </div>
	                	</div>
	                	<!-- <div class="uk-form-row">
		                    <label class="uk-form-label" for="supportMecoin"><span class="uk-text-danger">*</span>是否支持密券：</label>
		                    <div class="form-input">
		                    	<label><input type="radio" name="supportMecoin" checked value="1"> 是</label>
		                    	<label><input type="radio" name="supportMecoin" value="0"> 否</label>
		                    </div>
	                	</div> -->
	                	<div class="uk-form-row">
		                    <label class="uk-form-label" for="supportMecoin"><span class="uk-text-danger">*</span>用户等级限制：</label>
		                    <div class="form-input">
		                    	<select name="userRank" id="userRank" data-uk-tooltip="{pos:'right'}" title="选择多少等级以上才能购买" data-cached-title=""></select>
		                    </div>
	                	</div>
	                </div>
	            </div>
			</div>            
        </div>
        <div class="uk-panel uk-panel-box">
        	<div class="uk-grid">
	            <div class="uk-width-1-6">
	                <h2 class="uk-h3">商品信息</h2>
	            </div>
	            <div class="uk-width-5-6">
					<div class="uk-form-row">
	                    <label class="uk-form-label" for="goodsName"><span class="uk-text-danger">*</span>商品名称：</label>
	                    <div class="form-input">
	                        <input type="text" class="uk-form-width-medium" name="goodsName" data-uk-tooltip="{pos:'right'}" title="" data-cached-title=""  placeholder="商品名称" value="<?php echo set_value('goodsName'); ?>" required />
	                        <span class="uk-text-danger"><?php echo form_error('goodsName', '<em>', '</em>'); ?></span>
	                    </div>
	                </div>
	                <div class="uk-form-row">
	                    <label class="uk-form-label" for="subtitle"><span class="uk-text-danger">*</span>商品副标题：</label>
	                    <div class="form-input">
	                        <input type="text" class="uk-form-width-medium" name="subtitle" data-uk-tooltip="{pos:'right'}" title="" data-cached-title=""  placeholder="商品副标题" value="<?php echo set_value('subtitle'); ?>" required />
	                        <span class="uk-text-danger"><?php echo form_error('subtitle', '<em>', '</em>'); ?></span>
	                    </div>
	                </div>
	                 <div class="uk-form-row">
	                    <label class="uk-form-label" for="keywords"><span class="uk-text-danger">*</span>商品关键字：</label>
	                    <div class="form-input">
	                        <input type="text" class="uk-form-width-medium keywords" name="keywords" data-uk-tooltip="{pos:'right'}" title="商品关键字, 放在商品页的关键字中, 为搜索引擎收录用.多个关键字之间用逗号进行分隔" data-cached-title placeholder="商品关键字" value="<?php echo set_value('keywords'); ?>" required />
	                        <span class="uk-text-danger"><?php echo form_error('keywords', '<em>', '</em>'); ?></span>
	                    </div>
	                </div>	                
	                <div class="uk-form-row">
	                    <label class="uk-form-label" for="goodsCount"><span class="uk-text-danger">*</span>库存数量：</label>
	                    <div class="form-input">
	                        <input type="text" class="uk-form-width-small" name="goodsCount" maxlength="6" data-uk-tooltip="{pos:'right'}" title="大于0的整数" data-cached-title placeholder="商品库存数量" value="<?php echo set_value('goodsCount'); ?>" required />
	                        <span class="uk-text-danger"><?php echo form_error('goodsCount', '<em>', '</em>'); ?></span>
	                    </div>
	                </div>              
	                <div class="uk-form-row">
	                    <label class="uk-form-label" for="shopPrice"><span class="uk-text-danger">*</span>密点兑换数：</label>
	                    <div class="uk-form-icon">
						    <i class="uk-icon-cny"></i>
					     	<input type="text" class="uk-form-width-small" name="shopPrice" data-uk-tooltip="{pos:'right'}" title="单位：密点，1密点=1分钱" data-cached-title placeholder="当前兑换数" value="<?php echo set_value('shopPrice'); ?>" required />
	                        <span class="uk-text-danger"><?php echo form_error('shopPrice', '<em>', '</em>'); ?></span>
	                        <i class="uk-icon-cny"></i>
	                        <input type="text" class="uk-form-width-small marketPrice" name="marketPrice" data-uk-tooltip="{pos:'right'}" title="单位：人民币(元)" data-cached-title value="<?php echo set_value('marketPrice'); ?>" placeholder="市场售价" />
	                        <span class="uk-text-danger"><?php echo form_error('marketPrice', '<em>', '</em>'); ?></span> 
						</div>
	                </div>
	                <div class="uk-form-row">
	                	<label class="uk-form-label" for="startTime"><span class="uk-text-danger">*</span>销售日期：</label>
	                	 <div class="uk-form-icon">
    						<i class="uk-icon-calendar"></i>
	                	 	<input type="text" name="startTime" class="uk-form-width-small" data-uk-tooltip="{pos:'right'}" title="时间格式：2014-12-12" data-cached-title data-uk-datepicker="{format:'YYYY-MM-DD'}" placeholder="开始时间" value="<?php echo set_value('startTime'); ?>" required />
	                	 	<i class="uk-icon-calendar"></i>
	                	 	<input type="text" name="endTime" class="uk-form-width-small" data-uk-tooltip="{pos:'right'}" title="时间格式：2014-12-12" data-cached-title data-uk-datepicker="{format:'YYYY-MM-DD'}"  placeholder="结束时间" value="<?php echo set_value('endTime'); ?>" required />
	                	 	<span class="uk-text-danger"><?php echo form_error('startTime', '<em>', '</em>'); ?></span>
	                	 </div>
	                </div>	                
	                <div class="uk-form-row">
	                    <label class="uk-form-label" for="goodsImg"><span class="uk-text-danger">*</span>商品图片：</label>
	                   	<ul class="uk-list add-img-list"><li><?php echo form_upload('shopsImgone');?><?php echo form_upload('shopsImgtwo');?></li></ul>

	                   	<span class="uk-text-danger" id="imgUploadError"><?php echo $check_goods_img; ?></span>
	                </div>
	            </div>
	        </div> 
        </div> 
        <div class="uk-panel uk-panel-box">
        	<div class="uk-grid">
	            <div class="uk-width-1-6">
	                <h2 class="uk-h3">其他信息</h2>
	            </div>
	            <div class="uk-width-5-6">
	            	<div class="uk-form-row">
	                	<label class="uk-form-label" for="getAging"><span class="uk-text-danger">*</span>到店领取时间：</label>
	                	<div class="form-input">
	                		<input type="text" class="uk-form-width-medium getAging" name="getAging" data-uk-tooltip="{pos:'right'}" title="规定天数内领取，过期无效" data-cached-title placeholder="输入正整数的天数" value="<?php echo set_value('keywords'); ?>" required />
	                        <span class="uk-text-danger"><?php echo form_error('getAging', '<em>', '</em>'); ?></span>
	                	</div>
	                </div>
	            	<div class="uk-form-row">
	            		<input type="hidden" name="shopID" id="shopHidden" />
	                    <label class="uk-form-label" for="shopList"><span class="uk-text-danger">*</span>选择店铺：</label>
	                    <div class="shop-list" id="shopList"><a href="<?php echo base_url();?>index.php/shop?act=add">添加店铺</a></div>
	                </div>
            		<div class="uk-form-row">
	                    <label class="uk-form-label" for="brief"><span class="uk-text-danger">*</span>商品简要描述：</label>
	                    <div class="form-input">
	                        <textarea cols="40" rows="3" data-uk-tooltip="{pos:'right'}" title="" data-cached-title placeholder="" name="brief" class="brief"><?php echo set_value('brief'); ?></textarea>
	                    </div>
	                </div>				
	                <div class="uk-form-row">
	                    <label>&nbsp;商品详细描述：</label>
                    	<script id="editor" type="text/plain" class="uk-width-1-1 ueditor"></script>
	                </div>
				  	<div class="uk-form-row">
	                    <label class="uk-form-label" for="remark">&nbsp;备注：</label>
	                    <div class="form-input">
	                        <textarea cols="40" rows="3" data-uk-tooltip="{pos:'right'}" title="商品的商家备注,仅商家可见" data-cached-title placeholder="商品的商家备注,仅商家可见" name="remark" class="remark"><?php echo set_value('remark'); ?><?php echo set_value('remark'); ?></textarea>
	                    </div>
	                </div>
	                <hr />	                
	                <div class="uk-form-row form-button">
			            <button class="uk-button uk-button-large uk-button-primary addGoods" type="submit">确定</button>
			        </div>
	            </div>
        	</div>
        </div>       
    </form>
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


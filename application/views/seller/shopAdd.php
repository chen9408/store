<p class="uk-text-large uk-text-muted">店铺管理&ndash;添加s新店铺</p>
<div class="uk-width-medium-1-1">
	<div class="uk-width-medium-1-2 goods-medium">
		<?php echo form_open_multipart('shop?act=saveShopInfo');?>
		<div class="uk-panel uk-panel-box">
			<div class="uk-grid">
				<div class="uk-width-1-6">
	                <h2 class="uk-h3">实体店铺信息</h2>                 	
	            </div>
	            <div class="uk-width-5-6">
	            	<div class="uk-form-row">
	                    <label class="uk-form-label" for="shopName"><span class="uk-text-danger">*</span>店铺名称：</label>
	                    <div class="form-input">
	                        <input type="text" class="uk-form-width-medium" maxlength="20" name="shopName" data-uk-tooltip="{pos:'right'}" title="例：望湘园（娄山关路店）" data-cached-title="" placeholder="店铺名称（**路店）" required />
	                    </div>
	                </div>
	                <div class="uk-form-row">
	                    <label class="uk-form-label" for="shopName"><span class="uk-text-danger">*</span>店铺图片：</label>
	                    <div class="form-input">
							 <?php echo form_upload('shopsImg');?>
	                    </div>
	                </div>
	                <div class="uk-form-row">
	                    <label class="uk-form-label" for="details"><span class="uk-text-danger">*</span>店铺地址：</label>
	                    <div class="form-input">
	                    	<input type="hidden" name="longitude" id="longitude" />
	                    	<input type="hidden" name="latitude" id="latitude" />
                            <select id="province">
                                <option value="">请选择省市/其他</option><option value="北京" data="110000">北京</option><option value="天津" data="120000">天津</option><option value="河北省" data="130000">河北省</option><option value="山西省" data="140000">山西省</option><option value="内蒙古自治区" data="150000">内蒙古自治区</option><option value="辽宁省" data="210000">辽宁省</option><option value="吉林省" data="220000">吉林省</option><option value="黑龙江省" data="230000">黑龙江省</option><option value="上海" data="310000">上海</option><option value="江苏省" data="320000">江苏省</option><option value="浙江省" data="330000">浙江省</option><option value="安徽省" data="340000">安徽省</option><option value="福建省" data="350000">福建省</option><option value="江西省" data="360000">江西省</option><option value="山东省" data="370000">山东省</option><option value="河南省" data="410000">河南省</option><option value="湖北省" data="420000">湖北省</option><option value="湖南省" data="430000">湖南省</option><option value="广东省" data="440000">广东省</option><option value="广西壮族自治区" data="450000">广西壮族自治区</option><option value="海南省" data="460000">海南省</option><option value="重庆" data="500000">重庆</option><option value="四川省" data="510000">四川省</option><option value="贵州省" data="520000">贵州省</option><option value="云南省" data="530000">云南省</option><option value="西藏自治区" data="540000">西藏自治区</option><option value="陕西省" data="610000">陕西省</option><option value="甘肃省" data="620000">甘肃省</option><option value="青海省" data="630000">青海省</option><option value="宁夏回族自治区" data="640000">宁夏回族自治区</option><option value="新疆维吾尔自治区" data="650000">新疆维吾尔自治区</option>
                            </select>
                            <select id="city">
                                <option>请选择城市</option>
                            </select>
                             <select id="area">
                                <option>请选择区县</option>
                            </select>
                            <div class="form-input address-input">
                            	<input type="text" class="uk-form-width-medium" id="address" name="address" data-uk-tooltip="{pos:'left'}" title="" data-cached-title=""  placeholder="请准确填写详细地址" required />
                            </div>
                        	<button class="uk-button uk-button-primary point-btn" id="pointOnMap" data-uk-modal="{target:'#mapModel'}" type="button">地图上标注</button>
                        </div>
	                </div>
	                <div class="uk-form-row">
	                    <label class="uk-form-label" for="manager"><span class="uk-text-danger">*</span>店长姓名：</label>
	                    <div class="form-input">
	                        <input type="text" class="uk-form-width-medium" name="manager" data-uk-tooltip="{pos:'right'}" title="" data-cached-title=""  placeholder="店长或负责人姓名" required />
	                    </div>
	                </div>
	                <div class="uk-form-row">
	                    <label class="uk-form-label" for="telephone"><span class="uk-text-danger">*</span>联系电话：</label>
	                    <div class="form-input">
	                        <input type="text" class="uk-form-width-medium" name="telephone" data-uk-tooltip="{pos:'right'}" title="" data-cached-title=""  placeholder="联系方式固话或手机" maxlength="11" required />
	                    </div>
	                </div>
	                <div class="uk-form-row">
	                    <label class="uk-form-label" for="startTime"><span class="uk-text-danger">*</span>营业时间：</label>
	                    <div class="form-input">
	                    	<input type="text" class="uk-form-width-small" data-uk-tooltip="{pos:'bottom'}" title="开门时间，例：00:00" data-cached-title="" placeholder="开门时间" value="08:00" name="startTime" />
	                    	<input type="text" class="uk-form-width-small" data-uk-tooltip="{pos:'bottom'}" title="关门时间，例：20:00" data-cached-title="" placeholder="关门时间" value="20:00" name="endTime" />
	                    </div>	                   
	                </div>	          
	            </div>              	
        	</div>
        	<div class="uk-grid">
        		<div class="uk-width-1-6">
	                <h2 class="uk-h3">店铺账号信息</h2>                 	
	            </div>
	            <div class="uk-width-5-6">
	            	<div class="uk-form-row">
	                    <label class="uk-form-label" for="username"><span class="uk-text-danger">*</span>用户名：</label>
	                    <div class="form-input">
	                        <input type="text" class="uk-form-width-medium" name="username" data-uk-tooltip="{pos:'right'}" title="用于登录管理该店铺(中英文皆可最长6位)" data-cached-title="" placeholder="请输入用户名" maxlength="6" required />
	                        <span class="uk-text-danger" id="usernameErr"></span>
	                    </div>
	                </div>
	                <div class="uk-form-row">
                        <label class="uk-form-label" for="password"><span class="uk-text-danger">*</span>密码：</label>
                        <div class="form-input">
                            <input type="password" class="uk-form-width-medium" id="password" name="password" data="register" data-uk-tooltip="{pos:'right'}" title="字母、数字或者英文符号，最短6位最长12位" placeholder="请输入密码" data-cached-title="" maxlength="12" required />
                            <span class="uk-text-danger"></span>
                        </div>
                    </div> 
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="agpassword"><span class="uk-text-danger">*</span>确认密码：</label>
                        <div class="form-input">
                            <input type="password" class="uk-form-width-medium" placeholder="请输入确认密码" id="agpassword" name="agpassword" data="register" data-uk-tooltip="{pos:'right'}" title="" data-cached-title="" maxlength="12" required />
                            <span class="uk-text-danger"></span>
                        </div>
                    </div>
	            </div>
        	</div>
        	<hr />
    		<button class="uk-button uk-button-large uk-button-primary uk-push-2-5" type="submit" id="save" >保存提交</button>	          
        </div>       
    <?php echo form_close();?>
	</div>
	<div id="mapModel" class="uk-modal">
	    <div class="uk-modal-dialog">
	        <a class="uk-modal-close uk-close"></a>
	       <!--  <div class="uk-form">
                <label class="uk-form-label" for="telephone"><span class="uk-text-danger">*</span>店铺详细地址：</label>
                <div class="form-input">
                    <input type="text" class="uk-form-width-medium" id="addressCopy" placeholder="请准确填写详细地址" />
                </div>
                <button class="uk-button uk-button-primary point-btn" id="pointOnMap" type="button">重新定位</button>
            </div> -->
            <span class="uk-text-muted">注：如果系统定位不满意，可以拖动图标放在合适位置</span>
            <button class="uk-button uk-button-primary" id="saveLocation" type="button">确定</button>
            <div id="iCenter" class="map-main"></div>            
	    </div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>public/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/additional-method.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/jquery.metadata.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/jquery.md5.js"></script>
<script type="text/javascript" src="http://apis.mapabc.com/webapi/auth.json?t=javascriptmap&v=3.1.1&key=b0a7db0b3a30f944a21c3682064dc70ef5b738b062f6479a5eca39725798b1ee300bd8d5de3a4ae3"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/store-map.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/store-shop.js"></script>

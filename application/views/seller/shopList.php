<?php
	function _parseStatus($num,$checkStatus){
		if($checkStatus==$num){
			return 'selected';
		}
		return '';
	}
	function _parseTime($time){
		return date('H:i',$time);
	}
	function _returnList($shop_list){
		$list ='';
		if(empty($shop_list)){
			return '<a href="'.base_url().'index.php/shop?act=add">添加店铺</a>';
		}
		foreach ($shop_list as $key => $value) {
			$list .= '<div class="uk-width-1-4">'.
			'<div class="uk-panel uk-panel-box seller-box">'.
				'<dl class="dl-horizontal"><dt>店铺状态：</dt>'.
				'<dd><select id="shopList" data="'.$value["shopID"].'"><option value="0" '._parseStatus(0,$value["status"]).'>开门营业</option><option value="1" '._parseStatus(1,$value["status"]).'>关门停业</option></select></dd></dl>'.
                '<dl class="dl-horizontal"><dt>用户名：</dt><dd>'.$value["username"].'</dd></dl>'.
				'<dl class="dl-horizontal"><dt>店铺名称：</dt><dd>'.$value["shopName"].'</dd></dl>'.
                '<dl class="dl-horizontal"><dt>店铺图片：</dt><dd>店铺图片</dd></dl>'.
				'<dl class="dl-horizontal"><dt>店铺地址：</dt><dd>'.$value["address"].'</dd></dl>'.
				'<dl class="dl-horizontal"><dt>店长姓名：</dt><dd>'.$value["manager"].'</dd></dl>'.
				'<dl class="dl-horizontal"><dt>联系电话：</dt><dd>'.$value["telephone"].'</dd></dl>'.
				'<dl class="dl-horizontal"><dt>营业时间：</dt><dd>'._parseTime($value["startTime"]).'-'._parseTime($value["endTime"]).'</dd></dl>'.
				'<div class="uk-form-row">'.
				'<button class="uk-button uk-button-small uk-float-right" type="button" data-uk-modal="{target:\'#model\'}" id="edit" data="'.$value["shopID"].'">修改店铺信息</button>'.
				'</div>'.
			'</div>'.
		'</div>';
		}	
		return $list;
	}	
?>
<p class="uk-text-large uk-text-muted">店铺管理&ndash;店铺列表</p>
<div class="uk-width-medium-1-1">
	<div class="uk-grid" id="shopList">
		<?php echo _returnList($shop_list);?>
	</div>
	 <div id="model" class="uk-modal">
	    <div class="uk-modal-dialog">
	        <a class="uk-modal-close uk-close"></a>
	        <form class="uk-form uk-form-horizontal" id="shop" data="">
                <h2>修改店铺信息</h2>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="shopName"><span class="uk-text-danger">*</span>店铺名称：</label>
                    <div class="form-input">
                        <input type="text" class="uk-form-width-medium" id="shopName" name="shopName" data-uk-tooltip="{pos:'right'}" title="例：望湘园（娄山关路店）" data-cached-title="" placeholder="店铺名称（**路店）" required />
                    </div>
                </div>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="shopName"><span class="uk-text-danger">*</span>店铺图片：</label>
                    <div class="form-input">
                        <input type="file" name='shopsImg' >
                    </div>
                </div>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="details"><span class="uk-text-danger">*</span>店铺地址：</label>
                    <div class="form-input">
                        <select id="province" name="province">
                            <option value="">请选择省市/其他</option><option value="北京" data="110000">北京</option><option value="天津" data="120000">天津</option><option value="河北省" data="130000">河北省</option><option value="山西省" data="140000">山西省</option><option value="内蒙古自治区" data="150000">内蒙古自治区</option><option value="辽宁省" data="210000">辽宁省</option><option value="吉林省" data="220000">吉林省</option><option value="黑龙江省" data="230000">黑龙江省</option><option value="上海" data="310000">上海</option><option value="江苏省" data="320000">江苏省</option><option value="浙江省" data="330000">浙江省</option><option value="安徽省" data="340000">安徽省</option><option value="福建省" data="350000">福建省</option><option value="江西省" data="360000">江西省</option><option value="山东省" data="370000">山东省</option><option value="河南省" data="410000">河南省</option><option value="湖北省" data="420000">湖北省</option><option value="湖南省" data="430000">湖南省</option><option value="广东省" data="440000">广东省</option><option value="广西壮族自治区" data="450000">广西壮族自治区</option><option value="海南省" data="460000">海南省</option><option value="重庆" data="500000">重庆</option><option value="四川省" data="510000">四川省</option><option value="贵州省" data="520000">贵州省</option><option value="云南省" data="530000">云南省</option><option value="西藏自治区" data="540000">西藏自治区</option><option value="陕西省" data="610000">陕西省</option><option value="甘肃省" data="620000">甘肃省</option><option value="青海省" data="630000">青海省</option><option value="宁夏回族自治区" data="640000">宁夏回族自治区</option><option value="新疆维吾尔自治区" data="650000">新疆维吾尔自治区</option>
                        </select>
                        <select id="city" name="city">
                            <option>请选择城市</option>
                        </select>
                         <select id="area" name="area">
                            <option>请选择区县</option>
                        </select>
                        <div class="form-input address-input">
                        	<input type="text" id="address" class="uk-form-width-medium" name="address" data-uk-tooltip="{pos:'right'}" title="" data-cached-title=""  placeholder="请准确填写详细地址" required />
                        </div>                            
                    </div>
                </div>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="manager"><span class="uk-text-danger">*</span>店长姓名：</label>
                    <div class="form-input">
                        <input type="text" class="uk-form-width-medium" id="manager" name="manager" data-uk-tooltip="{pos:'right'}" title="" data-cached-title=""  placeholder="店长或负责人姓名" required />
                    </div>
                </div>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="telephone"><span class="uk-text-danger">*</span>联系电话：</label>
                    <div class="form-input">
                        <input type="text" class="uk-form-width-medium" id="telephone" name="telephone" data-uk-tooltip="{pos:'right'}" title="" data-cached-title=""  placeholder="联系方式固话或手机" maxlength="11" required />
                    </div>
                </div>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="startTime"><span class="uk-text-danger">*</span>营业时间：</label>
                    <div class="form-input">
                    	<input type="text" class="uk-form-width-small" id="startTime" data-uk-tooltip="{pos:'bottom'}" title="开门时间，例：00:00" data-cached-title="" placeholder="开门时间" value="08:00" name="startTime" />
                    	<input type="text" class="uk-form-width-small" id="endTime" data-uk-tooltip="{pos:'bottom'}" title="关门时间，例：20:00" data-cached-title="" placeholder="关门时间" value="20:00" name="endTime" />
                    </div>	                   
                </div>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="username"><span class="uk-text-danger">*</span>用户名：</label>
                    <div class="form-input">
                        <input type="text" class="uk-form-width-medium" id="username" data-uk-tooltip="{pos:'right'}" title="用于登录管理该店铺(中英文皆可最长6位)" data-cached-title="" placeholder="请输入用户名" maxlength="6" disabled required />
                    </div>
                </div>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="password"><span class="uk-text-danger">*</span>密码：</label>
                    <div class="form-input">
                        <input type="password" class="uk-form-width-medium" id="password" name="password" data="register" data-uk-tooltip="{pos:'right'}" title="字母、数字或者英文符号，最短6位最长12位" placeholder="不修改可以不填" data-cached-title="" maxlength="12" required />
                        <span class="uk-text-danger"></span>
                    </div>
                </div> 
                <hr />
                <div class="uk-form-row" style="text-align:center;">
	                <button class="uk-button" id="update" type="button">保存提交</button>
	            </div>
            </form>
	    </div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>public/js/jquery.md5.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/additional-method.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/jquery.metadata.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/store-shop.js"></script>

<body class="uk-height-1-1">
    <nav class="tm-navbar uk-navbar uk-navbar-attached">
        <div class="uk-container uk-container-center">
            <a class="uk-navbar-brand uk-hidden-small" href="<?php echo base_url();?>" title="道客商城">
                <img class="uk-margin uk-margin-remove" width="140" height="120" src="<?php echo base_url();?>public/img/logo.gif" width="90" height="30" alt="道客商城">
            </a>
             <ul class="uk-navbar-nav uk-hidden-small">
                <li><a href="<?php echo base_url();?>index.php/logout" target="_top">退出</a></li>
            </ul>
            <a href="#tm-offcanvas" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas=""></a>
            <div class="uk-navbar-brand uk-navbar-center uk-visible-small"><img src="<?php echo base_url();?>public/img/logo.gif" width="140" height="120" title="UIkit" alt="UIkit"></div>
        </div>
    </nav>
    <div class="uk-grid">
        <div class="uk-width-medium-1-1">
            <div class="uk-width-medium-1-2 goods-medium user-register">
                <div class="processor" id="step">
                    <ul>
                        <li class="prev size1of2">
                            <div class="step_inner"> 
                                <i class="icon_step">1</i>
                                <h4>填写基本信息</h4>
                            </div>
                        </li>
                        <li class="prev no_extra">
                            <div class="step_inner"> 
                                <i class="icon_step">2</i>
                                <h4>邮箱激活</h4>
                            </div>
                        </li>
                        <li class="size1of2 last">
                            <div class="step_inner"> 
                                <i class="icon_step">3</i>
                                <h4>完善卖家信息</h4>
                            </div>
                        </li>   
                    </ul>
                </div>
                <form class="uk-panel uk-panel-box uk-form" action="<?php echo base_url();?>index.php/request/register?act=saveSellerInfo" enctype="multipart/form-data" method="post" id="step3">
                	<div class="uk-push-1-6 uk-width-3-4">
					<input type="hidden" value="<?php echo $accountID;?>" name="accountID">
                    <input type="hidden" value="<?php echo $sellerID;?>" id="s_id" name="s_id">				
                    <h4>用户信息</h4>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="corporateName"><span class="uk-text-danger">*</span>法人代表：</label>
                        <div class="form-input">
                            <input type="text" class="uk-form-width-medium" id="corporateName"  name="corporateName" data-uk-tooltip="{pos:'right'}" title="" data-cached-title=""  maxlength="32" required />
                            <span class="uk-text-danger"></span>
                        </div>
                    </div>
					<div class="uk-form-row">
                        <label class="uk-form-label" for="companyName"><span class="uk-text-danger">*</span>公司名称：</label>
                        <div class="form-input">
                            <input type="text" class="uk-form-width-medium" id="companyName"  name="companyName" data-uk-tooltip="{pos:'right'}" title="需与营业执照上的名称完全一致，信息审核成功后，公司名称不可修改" data-cached-title=""  maxlength="32" required />
                            <span class="uk-text-danger"></span>
                        </div>
                    </div>
                    <div class="uk-form-row">
	                	<label class="uk-form-label" for="companyRegTime"><span class="uk-text-danger">*</span>成立时间：</label>
	                	<div class="uk-form-icon">
    						<i class="uk-icon-calendar"></i>
	                	 	<input type="text" name="companyRegTime" class="uk-form-width-medium" id="companyRegTime" data="add" data-uk-datepicker="{format:'YYYY-MM-DD'}" required />
	                	</div>
	                </div>
	                <div class="uk-form-row">
                        <label class="uk-form-label" for="companyRegAdd"><span class="uk-text-danger">*</span>公司注册地址：</label>
                        <div class="form-input">
                            <input type="text" class="uk-form-width-medium" id="companyRegAdd" name="companyRegAdd" data-uk-tooltip="{pos:'right'}" title="" data-cached-title="" required />
                            <span class="uk-text-danger"></span>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="companyBank"><span class="uk-text-danger">*</span>公司开户银行：</label>
                        <div class="form-input">
                            <input type="text" class="uk-form-width-medium" id="companyBank" name="companyBank" data-uk-tooltip="{pos:'right'}" title="" data-cached-title="" equired />
                            <span class="uk-text-danger"></span>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="bankAccount"><span class="uk-text-danger">*</span>银行账户：</label>
                        <div class="form-input">
                            <input type="text" class="uk-form-width-medium" id="bankAccount" name="bankAccount" maxlength="22" data-uk-tooltip="{pos:'right'}" title="" data-cached-title="" required />
                            <span class="uk-text-danger"></span>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="licenseNumber"><span class="uk-text-danger">*</span>营业执照注册号：</label>
                        <div class="form-input">
                            <input type="text" class="uk-form-width-medium" id="licenseNumber" name="licenseNumber" data-uk-tooltip="{pos:'right'}" title="请输入15位营业执照注册号" maxlength="15" data-cached-title="" required />
                            <span class="uk-text-danger"></span>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="licenseScanPreview"><span class="uk-text-danger">*</span>营业执照扫描件：</label>
                        <div class="form-input">
                        	<ul class="uk-list add-img-list">
		                   		<li data-uk-tooltip="{pos:'top'}" title="请上传营业执照清晰彩色原件扫描件或数码照在有效期内且年检章齐全（当年成立的可无年检章）由中国大陆工商局或市场监督管理局颁发支持.jpg .jpeg .bmp .gif格式照片，大小不超过2M。" data-cached-title>
		                   			<a href="javascript:;" id="licenseScan" class="add-img jqzoom" style="display:none;"></a>
		                   			<a class="uk-form-file " href="javascript:;">添加 <input class="imgUpload" data="licenseScan" name="licenseScanPreview" type="file" accept="image/*" require/></a>
		                   		</li>
	                   		</ul>
                            <span class="uk-text-danger"></span>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="orgCode"><span class="uk-text-danger">*</span>组织机构代码：</label>
                        <div class="form-input">
                            <input type="text" class="uk-form-width-medium" id="orgCode" name="orgCode" data-uk-tooltip="{pos:'right'}" title="请输入组织机构代码，如12345678-9" data-cached-title="" required />
                            <span class="uk-text-danger"></span>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="orgScanPreview"><span class="uk-text-danger">*</span>组织机构代码扫描件：</label>
                        <div class="form-input">
                        	<ul class="uk-list add-img-list">
		                   		<li data-uk-tooltip="{pos:'top'}" title="请上传加盖公章的扫描件支持.jpg .jpeg .bmp .gif格式照片，大小不超过2M" data-cached-title>
		                   			<a href="javascript:;" id="orgScan" class="add-img jqzoom" style="display:none;"></a>
		                   			<a class="uk-form-file " href="javascript:;">添加 <input class="imgUpload" data="orgScan" name="orgScanPreview" type="file" accept="image/*" require/></a>
		                   		</li>
	                   		</ul>
                            <span class="uk-text-danger"></span>
                        </div>
                    </div>
                    <h4>卖家信息</h4>
					<div class="uk-form-row">
                        <label class="uk-form-label" for="name"><span class="uk-text-danger">*</span>运营者姓名：</label>
                        <div class="form-input">
                            <input type="text" class="uk-form-width-medium" id="name"  name="name" data-uk-tooltip="{pos:'right'}" title="" data-cached-title=""  maxlength="6" required />
                            <span class="uk-text-danger"></span>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="telephone"><span class="uk-text-danger">*</span>运营着手机号码：</label>
                        <div class="form-input">
                            <input type="text" class="uk-form-width-small" id="telephone"  name="telephone" data-uk-tooltip="{pos:'right'}" title="" data-cached-title=""  maxlength="11" required />
                            <button class="uk-button" type="button" disabled="disabled" id="getCode">获取验证码</button>
                            <span class="uk-text-danger"></span>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="verifyCode"><span class="uk-text-danger">*</span>短信验证码：</label>
                        <div class="form-input">
                            <input type="text" class="uk-form-width-small" id="verifyCode" data-uk-tooltip="{pos:'right'}" title="请输入四位短信验证码" data-cached-title=""  maxlength="4" required disabled="disabled" />
                            <span class="uk-text-danger"></span>
                        </div>
                    </div>
					<div class="uk-form-row">
                        <label class="uk-form-label" for="sellerName"><span class="uk-text-danger">*</span>商店名称：</label>
                        <div class="form-input">
                            <input type="text" class="uk-form-width-medium" id="sellerName"  name="sellerName" data-uk-tooltip="{pos:'right'}" title="" data-cached-title=""  maxlength="32" required />
                            <span class="uk-text-danger"></span>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="sellerAdd"><span class="uk-text-danger">*</span>商店联系地址：</label>
                        <div class="form-input">
                            <input type="text" class="uk-form-width-medium" id="sellerAdd"  name="sellerAdd" data-uk-tooltip="{pos:'right'}" title="" data-cached-title=""  maxlength="32" required />
                            <span class="uk-text-danger"></span>
                        </div>
                    </div>
                    </div>
                    <hr />
                	<button class="uk-button uk-button-large uk-button-primary uk-push-2-5" type="submit" id="over" disabled="disabled">保存提交</button>	
                </form>
            </div>
        </div>
	</div>
    <footer><strong>&copy; 2014</strong></footer>
    <script type="text/javascript" src="<?php echo base_url();?>public/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>public/js/additional-method.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>public/js/jquery.metadata.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>public/js/store-seller.js"></script>
    <script type="text/javascript">
    	$.UIkit.notify("邮箱已成功激活，完善资料就可以开店了", {status:'success'});
    </script>
</body>

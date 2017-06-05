<body class="uk-height-1-1">
    <nav class="tm-navbar uk-navbar uk-navbar-attached">
        <div class="uk-container uk-container-center">
            <a class="uk-navbar-brand uk-hidden-small" href="<?php echo base_url();?>" title="道客商城">
                <img class="uk-margin uk-margin-remove" width="140" height="120" src="<?php echo base_url();?>public/img/logo.gif" width="90" height="30" alt="道客商城">
            </a>           
            <a href="#tm-offcanvas" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas=""></a>
            <div class="uk-navbar-brand uk-navbar-center uk-visible-small"><img src="<?php echo base_url();?>public/img/logo.gif" width="140" height="120" title="UIkit" alt="UIkit"></div>
        </div>
    </nav>
	<div class="uk-width-medium-1-1">
		<div class="uk-width-medium-1-2 goods-medium">
			<p class="uk-text-large uk-text-muted">道客商城&ndash;<a href="<?php echo base_url();?>index.php/shopLogin" title="子店铺登录">子店铺登录</a></p>

		</div>
	    <div class="uk-width-medium-1-2 goods-medium user-register" style="height:300px;">	    	
            <form class="uk-panel uk-panel-box uk-form" action="<?php echo base_url();?>index.php/shopLogin" method="post">
        	  	<div class="uk-form-row">
                    <label class="uk-form-label" for="username"><span class="uk-text-danger">*</span>账号：</label>
                    <div class="form-input">
                        <input type="text" class="uk-form-width-medium" id="username" name="username" data-uk-tooltip="{pos:'right'}" title="子店铺账号" data-cached-title="" required />
                    </div>
                </div> 
                <div class="uk-form-row">
                    <label class="uk-form-label" for="password"><span class="uk-text-danger">*</span>密码：</label>
                    <div class="form-input">
                        <input type="password" class="uk-form-width-medium" id="password" name="password" data-uk-tooltip="{pos:'right'}" title="子店铺密码" data-cached-title="" required />
                    </div>
                </div>
                <p class="uk-text-danger uk-push-1-5"><?php echo $error;?></p>
                <hr />
                <button class="uk-button uk-button-large uk-button-primary uk-push-1-5" type="submit" id="login">登录</button>
            </form>
	    </div>
	</div>
</body>
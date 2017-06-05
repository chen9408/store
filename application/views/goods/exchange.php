<body class="uk-height-1-1">
    <nav class="tm-navbar uk-navbar uk-navbar-attached">
        <div class="uk-container uk-container-center">
            <a class="uk-navbar-brand uk-hidden-small" href="<?php echo base_url();?>" title="道客商城">
                <img class="uk-margin uk-margin-remove" width="140" height="120" src="<?php echo base_url();?>public/img/logo.gif" width="90" height="30" alt="道客商城">
            </a>
             <ul class="uk-navbar-nav uk-hidden-small">
                <li><a href="<?php echo base_url();?>index.php/shopLogout" target="_top">切换账号</a></li>
            </ul>         
            <a href="#tm-offcanvas" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas=""></a>
            <div class="uk-navbar-brand uk-navbar-center uk-visible-small"><img src="<?php echo base_url();?>public/img/logo.gif" width="140" height="120" title="UIkit" alt="UIkit"></div>
        </div>
    </nav>
	<div class="uk-width-medium-1-1">
		<div class="uk-width-medium-1-2 goods-medium">
			<p class="uk-text-large uk-text-muted">道客商城&ndash;<a href="<?php echo base_url();?>index.php/goods/exchange" title="兑换商品">兑换商品</a></p>
		</div>
	    <div class="uk-width-medium-1-2 goods-medium user-register" style="height:300px;">	    	
            <form class="uk-panel uk-panel-box uk-form" >
                <div class="card-group">
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="cardNumber"><span class="uk-text-danger">*</span>券码：</label>
                        <div class="form-input">
                            <input type="text" class="uk-form-width-medium" id="cardNumber" maxlength="10" name="cardNumber" data-uk-tooltip="{pos:'right'}" title="兑换券的账号" data-cached-title="" required />
                        </div>
                    </div> 
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="cardPassword"><span class="uk-text-danger">*</span>券密：</label>
                        <div class="form-input">
                            <input type="text" class="uk-form-width-medium" id="cardPassword" maxlength="5" name="cardPassword" data-uk-tooltip="{pos:'right'}" title="兑换券的密码" data-cached-title="" required />
                        </div>
                    </div>
                </div>      	  	
                <div class="uk-form-row uk-text-center">
                    <a href="javascript:;" class="addGroup">添加一组</a>
                    <a href="javascript:;" class="deleteGroup uk-text-danger">删除一组</a>
                </div>
                <p class="uk-text-danger uk-push-1-5"></p>
                <hr />
                <button class="uk-button uk-button-large uk-button-primary uk-push-1-5" type="button" id="check">兑换</button>
                <div id="exchanged-main"></div>
            </form>
	    </div>
	</div>
    <script type="text/javascript" src="<?php echo base_url();?>public/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>public/js/additional-method.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/jquery.metadata.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>public/js/store-exchange.js"></script>
</body>
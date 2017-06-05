<body class="uk-height-1-1">
    <nav class="tm-navbar uk-navbar uk-navbar-attached">
        <div class="uk-container uk-container-center">
            <a class="uk-navbar-brand uk-hidden-small" href="<?php echo base_url();?>" title="道客商城">
                <img class="uk-margin uk-margin-remove" width="140" height="120" src="<?php echo base_url();?>public/img/logo.gif" width="90" height="30" alt="道客商城">
            </a>
             <ul class="uk-navbar-nav uk-hidden-small">
                <li><a href="<?php echo base_url();?>index.php/login" target="_top">登录</a></li>
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
                        <li class="current size1of2">
                            <div class="step_inner"> 
                                <i class="icon_step">1</i>
                                <h4>填写基本信息</h4>
                            </div>
                        </li>
                        <li class="size1of2 no_extra">
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
                <form class="uk-panel uk-panel-box uk-form" id="step1">
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="email"><span class="uk-text-danger">*</span>邮箱：</label>
                        <div class="form-input">
                            <input type="email" class="uk-form-width-medium" id="email"  name="email" data="register" data-uk-tooltip="{pos:'right'}" title="常用的邮箱地址" data-cached-title="" required />
                            <span class="uk-text-danger"></span>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="verifyCode"><span class="uk-text-danger">*</span>验证码：</label>
                        <div class="form-input">
                            <input type="tel" class="uk-form-width-small" id="code" name="verifyCode" data="register" data-uk-tooltip="{pos:'right'}" title="" data-cached-title="" required />
                            <span class="uk-text-danger"></span>
                        </div>
                        <div class="verify-img">
                            <?php echo $verifyImg; ?>
                            <a href="javascript:;" class="getVerifyImg">看不清？换一张</a>
                        </div>
                    </div>
                    <div class="uk-width-1-1">
                       <label class="uk-push-1-6"><input type="checkbox" id="agreement"> 我同意并遵守上述的 <a href="<?php echo base_url();?>public/upload/道客商城商户管理规定.html" target="_blank">《道客商城商户管理规定》</a></label> 
                    </div>
                    <hr>
                    <button class="uk-button uk-button-large uk-button-primary uk-push-1-5" type="button" id="next" disabled>下一步</button>
                </form>
                <form class="uk-panel uk-panel-box uk-form" id="step2">
                    <div class="uk-push-1-6 uk-width-3-4">
                        <h3>感谢注册，确认邮件已发送至你的注册邮箱 : <span id="emailTit"></span></h3>
                        <p class="uk-text-muted">请进入邮箱查看邮件，并激活商家帐号。</p>
                        <p class="uk-text-muted">没收到邮件？</p>
                        <ul class="uk-list">
                            <li>1. 请检查邮箱地址是否正确，你可以返回<a href="javascript:;" id="rewrite">重新填写</a></li>
                            <li>2. 检查你的邮件垃圾箱</li>
                            <li>3. 若仍未收到确认，请尝试<a href="javascript:;" id="reSend">重新发送</a></li>
                        </ul>
                    </div>
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
        $.UIkit.notify("验证并激活邮箱！", {status:'success'});       
    </script>
</body>
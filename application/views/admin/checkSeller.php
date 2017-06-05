<p class="uk-text-large uk-text-muted">商家管理&ndash;商家列表</p>
<div class="uk-width-medium-1-1">
    <div class="uk-form-controls">
        <label class="uk-form-label" for="form-s-it">商家状态：</label>
        <label><input type="radio" name="sellerStatus" value="1" checked> 未审核</label>
        <label><input type="radio" name="sellerStatus" value="0"> 已通过</label>
        <label><input type="radio" name="sellerStatus" value="2"> 未通过</label>
        <label><input type="radio" name="sellerStatus" value="3"> 未完善资料</label>
    </div>
	<div class="uk-grid" id="sellerList"></div>
    <div id="model" class="uk-modal">
	    <div class="uk-modal-dialog">
	        <a class="uk-modal-close uk-close"></a>
	        <form class="uk-form uk-form-horizontal">
                <div class="uk-form-row">
                    <label class="uk-form-label" for="form-h-it">收件人：</label>
                    <div class="form-input">
                        <input type="text" id="toUser" placeholder="邮箱地址" disabled />
                    </div>
                </div>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="form-h-t">正文：</label>
                    <div class="form-input">
                        <textarea id="content" cols="30" rows="5" placeholder="反馈信息填写处" ></textarea>
                    </div>
                </div>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="form-h-t">审核结果：</label>
                    <div class="form-input">
                        <label><input type="radio" name="checkStatus" value="0" checked>通过</label>
                        <label><input type="radio" name="checkStatus" value="2">不通过</label>
                    </div>
                </div>
                <div class="uk-form-row">
                    <label class="uk-form-label" for="form-h-t">经营范围：</label>
                    <select id="province" name="province">
                        <option value="">请选择省市/其他</option>
                    </select>
                    <select id="city" name="city">
                        <option>请选择城市</option>
                    </select>
                </div>
                <div class="uk-form-row" style="text-align:center;">
	                <button class="uk-button" id="send" type="button">发送</button>
	            </div>
            </form>
	    </div>
	</div>
    <div id="imgModel" class="uk-modal">
        <div class="uk-modal-dialog uk-modal-dialog-frameless">
            <a href="" class="uk-modal-close uk-close uk-close-alt"></a>
            <img src="" alt="" id="imgModelURL">
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>public/js/juicer-min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/store-admin.js"></script>
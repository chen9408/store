<div class="uk-width-1-2 main-summary">
	<div class="uk-grid tm-grid-truncate" data-uk-grid-margin="">
	    <div class="uk-width-medium-1-4">
	        <div class="uk-panel uk-panel-box uk-panel-box-primary">
	            <h3 class="uk-panel-title">新消息</h3>
	            <p class="uk-panel-num"><a href="#">0</a></p>
	        </div>
	    </div>
	    <div class="uk-width-medium-1-4">
	        <div class="uk-panel uk-panel-box uk-panel-box-success">
	            <h3 class="uk-panel-title">下单数</h3>
	            <p class="uk-panel-num"><a href="<?php echo base_url();?>index.php/order?act=list"><?php echo $count;?></a></p>
	        </div>
	    </div>
	    <div class="uk-width-medium-1-4">
	        <div class="uk-panel uk-panel-box uk-panel-box-danger">
	            <h3 class="uk-panel-title">交易额</h3>
				<p class="uk-panel-num"><a href="<?php echo base_url();?>index.php/order?act=list">￥<?php echo $sum;?>.00</a></p>
	        </div>
	    </div>
	</div>
</div>
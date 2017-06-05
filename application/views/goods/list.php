<p class="uk-text-large uk-text-muted">商品管理&ndash;商品列表</p>
<div class="uk-width-medium-1-1">
	<div class="uk-width-medium-9-10 goods-medium">
   		<div class="uk-form-controls">
	        <label class="uk-form-label" for="form-s-it">商品类型：</label>	    
	      	<select id="goodsType">
	      		<option value="0">全部</option>
                <option value="B">服务商品</option>
            </select>
			&brvbar;
   			<label class="uk-form-label" for="form-s-it">商品状态：</label>
	        <label><input type="radio" name="goodsStatus" value="0" checked> 已通过</label>
	        <label><input type="radio" name="goodsStatus" value="1">下架</label>	       
	    </div>
	    <hr />
	    <div class="uk-width-medium-1-1 goods-list" id="goodsList" data=""></div>
	    <div class="uk-widht-medium-1-1" id="pageSet">
			<ul class="uk-pagination">
				<li><a href="javascript:;" id="prevPage" data="0">上一页</a></li>
				<li><span>共 <i id="totalPage"></i> 页</span><span>当前 <input type="number" min="1" class="uk-form-width-mini uk-form-small" id="currentPage"> 页</span><span>共 <i id="goodsCount"></i> 条</span></li>
				<li><a href="javascript:;" id="nextPage" data="2">下一页</a></li>
			</ul>
		</div>	
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>public/js/juicer-min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/store-goodsList.js"></script>

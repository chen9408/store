<p class="uk-text-large uk-text-muted">订单管理&ndash;订单列表</p>
<p>导出</p>
<div class="uk-width-medium-1-1">
	<div class="uk-width-medium-9-10 goods-medium">
   		<div id="orderList">
   			<table class="uk-table uk-table-striped">
                <thead>
                    <tr>
                        <th>买家</th><th>商品</th><th>数量</th><th>价格</th>
                        <th>
                        	<select id="orderStatus">
                        		<option value="0">交易状态</option>
                        		<option value="1">等待买家付款</option>
                        		<option value="2">买家已付款</option>
                        		<option value="3">买家取消订单</option>
                        		<option value="4">买家申请退款</option>
                        		<option value="5">卖家已退款</option>
                        		<option value="6">交易成功</option>
                        		<option value="7">交易关闭</option>
                        	</select>
                        </th>
                    	<th>下单时间</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
           <ul class="uk-pagination" id="pageSet" data="">
           		<li><a href="javascript:;" id="prevPage" data="0">上一页</a></li>
           		<li><span>共 <i id="totalPage"></i> 页</span><span>当前 <i id="currentPage">1</i> 页</span><span>共 <i id="ordersCount"></i> 条</span></li>
           		<li><a href="javascript:;" id="nextPage" data="2">下一页</a></li>
           	</ul>
   		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>public/js/juicer-min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/store-order.js"></script>

<p class="uk-text-large uk-text-muted">订单列表</p>
<div class="uk-width-medium-1-1">
	<div class="uk-width-medium-9-10 goods-medium">
   		<div id="insuranceList">
   			<table class="uk-table uk-table-striped">
                <thead>
                    <tr>
                        <th>保单号</th><th>姓名</th><th>身份证号码</th><th>联系电话</th><th>保险期间</th><th>份数</th><th>保费</th>
                        <th>
                        	<select id="insureStatus">
                        		<option value="0">全部</option>
                            <option value="1">未出单</option>
                        		<option value="2">已出单</option>
                        	</select>
                        </th>
                    	<th>下单时间</th>
                      <th>操作</th>
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
      <div class="info" style="display:none;">
        <h4>保单详情</h4>
        <p>被保险人</p>
        <div id="adultInfo"></div>
        <hr>
        <div id="minorInfo"></div>
        <hr>
        <form class="uk-form">
          <label for="">保单号：</label>
          <input type="text" name="insureID" style="width:50%;" class="uk-width-1-2" id="insureID" data-id="" placeholder="请填写保单号">
          <button type="button" class="uk-button uk-button-danger" id="outOf">确认出单</button>
          <p class="uk-text-danger title"></p>
        </form>
      </div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>public/js/juicer-min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/store-insure.js"></script>

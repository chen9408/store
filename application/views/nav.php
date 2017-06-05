<body class="nav-body">
	<div class="uk-width-medium-1-1">
   	<ul class="uk-nav uk-nav-side uk-nav-parent-icon" data-uk-nav>	    
		<?php
			$sellerID = $this->session->userdata('sellerID');
			if($sellerID == "admin"){
				echo '<li class="uk-parent"><a href="#">商品管理</a>'.
	        		'<div><ul class="uk-nav-sub">'.
	            	'<li><a target="main-frame" href="'.base_url().'index.php/goods?act=list">商品列表</a></li>'.
	        	'</ul></div></li><li class="uk-parent"><a href="#">商家管理</a>'.
				'<div><ul class="uk-nav-sub">'.
					'<li><a href="'.base_url().'index.php/seller?act=list" target="main-frame">商家列表</a></li>'.
				'</ul></div></li>';
			}else{
				echo '<li class="uk-parent"><a target="main-frame" href="'.base_url().'index.php/shop?act=getShopList">我的店铺</a></li>'.
					'<li class="uk-parent"><a target="main-frame" href="'.base_url().'index.php/business?act=businesslist">营业明细</li>'.
					'<li class="uk-parent"><a target="main-frame" href="'.base_url().'index.php/goods?act=list">我的商品</a></li>'.
					'<li class="uk-parent"><a target="main-frame" href="'.base_url().'index.php/order?act=list">订单列表</a></li>';
			}
		?>	    
	</ul>
	</div>
</body>
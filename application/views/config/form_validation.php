<?php
	$config = array(
        'login' =>array(
        	array(
            	'field'   => 'username', 
            	'label'   => '用户名', 
            	'rules'   => 'trim|required|xss_clean'
        	),
       		array(
				'field'   => 'daokePassword', 
            	'label'   => '密码', 
            	'rules'   => 'trim|required|xss_clean'
        	)
        ),
        'register' => array(
            array(
                'field'   => 'name', 
                'label'   => '姓名', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'IDCard', 
                'label'   => '身份证号码', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'sellerName', 
                'label'   => '商店名称', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'sellerIntro', 
                'label'   => '商店简介', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'sellerPhone', 
                'label'   => '手机号码', 
                'rules'   => 'trim|required|xss_clean'
            )
        ),
		'pointMatchRoad' =>array(
        	array(
            	'field'   => 'longitude', 
            	'label'   => '经度', 
            	'rules'   => 'trim|required|xss_clean'
        	),
       		array(
				'field'   => 'latitude', 
            	'label'   => '纬度', 
            	'rules'   => 'trim|required|xss_clean'
        	)
        ),
        'add_goods' => array(
            array(
                'field'   => 'goodsName', 
                'label'   => '商品名称', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'subtitle', 
                'label'   => '副标题', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'keywords', 
                'label'   => '关键字', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'goodsCount', 
                'label'   => '库存数量', 
                'rules'   => 'is_natural'
            ),
            array(
                'field'   => 'marketPrice', 
                'label'   => '市场售价', 
                'rules'   => 'numeric'
            ),
            array(
                'field'   => 'shopPrice', 
                'label'   => '本店售价', 
                'rules'   => 'numeric'
            ),
            array(
                'field'   => 'brief', 
                'label'   => '简要描述', 
                'rules'   => 'trim|xss_clean'
            )
        ),
        'confirm_orders' => array(
            array(
                'field'   => 'goodsID', 
                'label'   => '商品编号', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'accountID', 
                'label'   => '用户编号', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'amount', 
                'label'   => '商品数量', 
                'rules'   => 'is_natural_no_zero|required'
            ),
            array(
                'field'   => 'unitPrice', 
                'label'   => '商品单价', 
                'rules'   => 'required'
            ),
            array(
                'field'   => 'totalPrice', 
                'label'   => '订单总价', 
                'rules'   => 'required'
            ),
            array(
                'field'   => 'sign', 
                'label'   => '签名', 
                'rules'   => 'trim'
            )
        ),
        'phone_fee' => array(
            array(
                'field'   => 'goodsID', 
                'label'   => '商品编号', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'accountID', 
                'label'   => '用户编号', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'phone', 
                'label'   => '手机号', 
                'rules'   => 'trim|required|xss_clean'
            )
        ),
        'payment'   => array(
            array(
                'field'   => 'accountID', 
                'label'   => '商品编号', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'mecoin', 
                'label'   => '密点数', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'wecoin', 
                'label'   => '微点数', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'orderID', 
                'label'   => '订单编号', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'daokePassword', 
                'label'   => '密码', 
                'rules'   => 'trim|required|xss_clean'
            ) ,
            array(
                'field'   => 'sign', 
                'label'   => '签名', 
                'rules'   => 'trim|required|xss_clean'
            )
        ),
        'insurancePay' => array(
            array(
                'field'   => 'accountID', 
                'label'   => '商品编号', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'mecoin', 
                'label'   => '密点数', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'daokePassword', 
                'label'   => '密码', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'sign', 
                'label'   => '签名', 
                'rules'   => 'trim|required|xss_clean'
            )
        ),
        'withdraw_money' => array(
            array(
                'field'   => 'goodsID', 
                'label'   => '商品编号', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'accountID', 
                'label'   => '用户编号', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'daokePassword', 
                'label'   => '密码', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'sign', 
                'label'   => '签名', 
                'rules'   => 'trim|required|xss_clean'
            )
        ),
        'shop_login'    => array(
            array(
                'field'   => 'username', 
                'label'   => '账号', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'password', 
                'label'   => '密码', 
                'rules'   => 'trim|required|xss_clean'
            )
        ),
        'cancel_order'  => array(
            array(
                'field'   => 'accountID', 
                'label'   => '用户编号', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'orderID', 
                'label'   => '订单编号', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'sign', 
                'label'   => '签名', 
                'rules'   => 'trim|required|xss_clean'
            )
        ),
        'insure_order'  => array(
            array(
                'field'   => 'accountID', 
                'label'   => '用户编号', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'insurePeriod', 
                'label'   => '保险期间', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'amount', 
                'label'   => '数量', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'adultCount', 
                'label'   => '数量', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'minorCount', 
                'label'   => '数量', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'premium', 
                'label'   => '数量', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'insureName', 
                'label'   => '数量', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'insureIDCard', 
                'label'   => '数量', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'insurePhone', 
                'label'   => '数量', 
                'rules'   => 'trim|required|xss_clean'
            )
        ),
        'insure_payment'  => array(
            array(
                'field'   => 'accountID', 
                'label'   => '用户编号', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'orderID', 
                'label'   => '订单编号', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'daokePassword', 
                'label'   => '密码', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'mecoin', 
                'label'   => '总价', 
                'rules'   => 'trim|required|xss_clean'
            )
        ),
        'goods'        =>array(
            array(
                'field'   => 'goodsID', 
                'label'   => '商品编号', 
                'rules'   => 'trim|required|xss_clean'
            )
        ),
        'orderID'          =>array(
            array(
                'field'   => 'orderID', 
                'label'   => '订单编号', 
                'rules'   => 'trim|required|xss_clean'
            )
        ),
        'shopID'          =>array(
            array(
                'field'   => 'shopID', 
                'label'   => '店铺编号', 
                'rules'   => 'trim|required|xss_clean'
            )
        ),
        'addcomment'      =>array(
            array(
                'field'   => 'accountID', 
                'label'   => '用户编号', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'orderID', 
                'label'   => '订单编号', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'commentContent', 
                'label'   => '评论内容', 
                'rules'   => 'trim|required|xss_clean'
            ),
			 array(
                'field'   => 'commentType', 
                'label'   => '评论类型', 
                'rules'   => 'trim|required|xss_clean'
            )

		),
        'busWithComments' =>array(
            array(
                'field'   => 'orderID', 
                'label'   => '订单编号', 
                'rules'   => 'trim|required|xss_clean'
            ),
			array(
                'field'   => 'accountID', 
                'label'   => '用户编号', 
                'rules'   => 'trim|required|xss_clean'
            )
        ), 
        'addtoComment'    =>array(
             array(
                'field'   => 'accountID', 
                'label'   => '用户编号', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'orderID', 
                'label'   => '订单编号', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'buscommentID', 
                'label'   => '商家回复编号', 
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'commentContent', 
                'label'   => '评论内容', 
                'rules'   => 'trim|required|xss_clean'
            )
       ),
        'accountID'       => array(
            array(
                'field'   => 'accountID', 
                'label'   => '用户编号', 
                'rules'   => 'trim|required|xss_clean'
            )
        ),
		'donate' =>array(
        	array(
            	'field'   => 'accountID', 
            	'label'   => '用户编号', 
            	'rules'   => 'trim|required|xss_clean'
        	),
       		array(
				'field'   => 'daokePassword', 
            	'label'   => '密码', 
            	'rules'   => 'trim|required|xss_clean'
        	),
			array(
            	'field'   => 'amount', 
            	'label'   => '捐献数量', 
            	'rules'   => 'trim|required|xss_clean'
        	),
       		array(
				'field'   => 'sign', 
            	'label'   => '签名', 
            	'rules'   => 'trim|required|xss_clean'
        	)
        ),
		'donateList' =>array(
        	array(
            	'field'   => 'rankType', 
            	'label'   => '榜单类型', 
            	'rules'   => 'trim|required|xss_clean'
        	)
		),
		'rewardRank' =>array(
        	array(
            	'field'   => 'accountID', 
            	'label'   => '用户编号', 
            	'rules'   => 'trim|required|xss_clean'
        	),
			array(
            	'field'   => 'type', 
            	'label'   => '排名类型', 
            	'rules'   => 'trim|required|xss_clean'
        	)
		),
		'idNumber' =>array(
        	array(
            	'field'   => 'accountID', 
            	'label'   => '用户编号', 
            	'rules'   => 'trim|required|xss_clean'
        	),
			array(
            	'field'   => 'idNumber', 
            	'label'   => '身份证号', 
            	'rules'   => 'trim|required|xss_clean'
        	)
		),
		'reward' =>array(
			array(
            	'field'   => 'accountID', 
            	'label'   => '用户编号', 
            	'rules'   => 'trim|required|xss_clean'
        	),
			array(
            	'field'   => 'changedAmount', 
            	'label'   => '奖励金额(密点)', 
            	'rules'   => 'trim|required|xss_clean'
        	),
			array(
            	'field'   => 'pinsID', 
            	'label'   => '奖励密点编号', 
            	'rules'   => 'trim|required|xss_clean'
        	),
			array(
            	'field'   => 'orderID', 
            	'label'   => '订单单号', 
            	'rules'   => 'trim|required|xss_clean'
        	)
		)
    );
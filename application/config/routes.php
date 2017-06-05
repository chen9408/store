<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller']			= 'store/index';
$route['top'] 							= 'store/top';
$route['nav'] 							= 'store/nav';
$route['main'] 							= 'store/main';
$route['state']							= 'store/state';
$route['login']							= 'store/login';
$route['logout']						= 'store/logout';
$route['getVerifyImg']					= 'store/getVerifyImg';
$route['register']						= 'store/register';
$route['activeregitser']				= 'store/activeRegitser';
$route['shopLogin']						= 'store/shopLogin';
$route['shopLogout']					= 'store/shopLogout';
$route['inform']						= 'store/inform';
$route['request/register?(:any)'] 		= 'request/register';
$route['request/seller?(:any)'] 		= 'request/seller';
$route['request/shop?(:any)'] 			= 'request/shop';
$route['request/api?(:any)'] 			= 'request/api';
$route['request/order?(:any)'] 			= 'request/order';
$route['goods?(:any)'] 					= 'goods/index';
$route['goods/add']						= 'goods/add';
$route['goods/update'] 					= 'goods/update';
$route['goods/getGoodsList'] 			= 'goods/getGoodsList';
$route['goods/exchange'] 				= 'store/exchange';
$route['seller?(:any)'] 				= 'seller/index';
$route['shop?(:any)'] 				    = 'shop/index';
$route['ueditor?(:any)'] 				= 'ueditor/server';
$route['order?(:any)']					= 'order/index';
$route['insurance/create']				= 'insurance/create';
$route['insurance/fillIn']				= 'insurance/fillIn';
$route['insurance/request']				= 'insurance/request';
$route['insurance/policy']				= 'insurance/policy';
$route['business?(:any)']				= 'business/index';
/*APP*/
$route['app/index']						= 'app/index';
$route['app/storeInfo']					= 'app/storeInfo';
$route['app/sergoodslist']				= 'app/sergoodslist';
$route['app/payment']					= 'app/payment';
$route['app/location']					= 'app/location';
$route['app/goodsInfo']					= 'app/goodsInfo';
$route['app/goodsComment']				= 'app/goodsComment';
$route['app/getOrderList']				= 'app/getOrderList';
$route['app/getOrderDetail']			= 'app/getOrderDetail';
$route['app/applyShop']					= 'app/applyShop';
$route['app/addcomment']				= 'app/addcomment';
$route['app/submitPayment']				= 'app/submitPayment';  //支付成功
$route['app/phoneFee']					= 'app/phoneFee';
$route['app/withdraw']					= 'app/withdraw';
$route['app/weixinWithdraw']			= 'app/weixinWithdraw';
$route['app/donation']					= 'app/donation';
$route['app/insurance']					= 'app/insurance';
$route['app/confirmWithdraw']			= 'app/confirmWithdraw';
$route['app/bill']						= 'app/bill';
$route['app/balance/bill']				= 'app/bill';
$route['app/balance']					= 'app/balance';
$route['app/lottery']					= 'app/lottery';

$route['app/demo']						= 'app/demo';
/* out Api */
$route['storeapi/pointMatchRoad']		= 'storeapi/pointMatchRoad';
$route['storeapi/getGoodsSubType'] 		= 'storeapi/getGoodsSubType';
$route['storeapi/serGoodsList'] 		= 'storeapi/serGoodsList';
$route['storeapi/serGoodsInfo'] 		= 'storeapi/serGoodsInfo';
$route['storeapi/getGoodsInfo']		    = 'storeapi/virtualGoodsInfo';
$route['storeapi/virtualGoodsInfo']		= 'storeapi/virtualGoodsInfo';
$route['storeapi/applyShop'] 		    = 'storeapi/applyShop';
$route['storeapi/virtualGoodsList'] 	= 'storeapi/virtualGoodsList';
$route['storeapi/confirmOrder']			= 'storeapi/confirmOrder';
$route['storeapi/getOrderList']			= 'storeapi/getOrderList';
$route['storeapi/mallPay']				= 'storeapi/mallPay';
$route['storeapi/getOrderDetail']		= 'storeapi/getOrderDetail';
$route['storeapi/withdrawMoney']		= 'storeapi/withdrawMoney';
$route['storeapi/verifyIdNumber']		= 'storeapi/verifyIdNumber';
$route['storeapi/fixUserInfo']			= 'storeapi/fixUserInfo';
$route['storeapi/depositInfo']			= 'storeapi/depositInfo';
$route['storeapi/insurancePay']			= 'storeapi/insurancePay';
$route['storeapi/cancelOrder']			= 'storeapi/cancelOrder';
$route['storeapi/paymentCallback']		= 'storeapi/paymentCallback';
$route['storeapi/getUserInfo']			= 'storeapi/getUserInfo';
$route['storeapi/getUserfinance']		= 'storeapi/getUserfinance';
$route['storeapi/checkPhoneFee']		= 'storeapi/checkPhoneFee';
$route['storeapi/jiuQuery']				= 'storeapi/jiuQuery';
$route['storeapi/stateMentList']		= 'storeapi/stateMentList';
$route['storeapi/createPhoneFeeOrder']	= 'storeapi/createPhoneFeeOrder';
$route['storeapi/phoneFeeCallback']		= 'storeapi/phoneFeeCallback';
$route['storeapi/refundCallback']		= 'storeapi/refundCallback';
$route['storeapi/getMallBanners']		= 'storeapi/getMallBanners';
$route['storeapi/updateGoodsCount']		= 'storeapi/updateGoodsCount';
$route['storeapi/userRefund']			= 'storeapi/userRefund';
$route['storeapi/phonePayTiming']		= 'storeapi/phonePayTiming';
$route['storeapi/jiuQuery']				= 'storeapi/jiuQuery';
$route['storeapi/phoneFeeOrderRefund']	= 'storeapi/phoneFeeOrderRefund';
$route['storeapi/getHuafeiduoOrderList']= 'storeapi/getHuafeiduoOrderList';
$route['storeapi/insert_huafeiduo_order']= 'storeapi/insert_huafeiduo_order';
$route['storeapi/exchangeRedpack']		= 'storeapi/exchangeRedpack';
$route['storeapi/sendWXRedpack']		= 'storeapi/sendWXRedpack';
$route['storeapi/wxRedPackOrderRefund'] = 'storeapi/wxRedPackOrderRefund';
$route['storeapi/insuranceRefund']		= 'storeapi/insuranceRefund';
$route['storeapi/donateDaoke']			= 'storeapi/donateDaoke';
$route['storeapi/getRewardRank']        = 'storeapi/getRewardRank';
$route['storeapi/donateRankList']       = 'storeapi/donateRankList';
$route['storeapi/addComment']         	= 'storeapi/addComment';
$route['storeapi/getShopInfo']			= 'storeapi/getShopInfo';
$route['storeapi/comCountByType']       = 'storeapi/comCountByType';  
$route['storeapi/commentList']          = 'storeapi/commentList';
$route['storeapi/addtoComment']         = 'storeapi/addtoComment';
$route['storeapi/beforeComment']		= 'storeapi/beforeComment';
$route['storeapi/pins']					= 'storeapi/pins';
$route['storeapi/reward']				= 'storeapi/reward';
$route['storeapi/microChannelReword']	= 'storeapi/microChannelReword';
$route['storeapi/pinsOrderPayment']		= 'storeapi/pinsOrderPayment';
$route['storeapi/editOrderStatus']		= 'storeapi/editOrderStatus';
$route['storeapi/editOutsideID']		= 'storeapi/editOutsideID';
$route['storeapi/testapi']              = 'storeapi/testapi';
$route['(:any)'] 						= 'pages/view/$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
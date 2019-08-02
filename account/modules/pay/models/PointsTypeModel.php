<?php if (!defined('ROOT_PATH')) exit('No Permission');
/**
 * @author     Xinze <xinze@live.cn>
 */
class PointsTypeModel
{
    const   POINTS_ADD = 1;
    const   POINTS_MINUS = 2;

    const   POINTS_TYPE_REG      = 1;  //会员注册
    const   POINTS_TYPE_LOGIN    = 2;  //会员登录
    const   POINTS_TYPE_EVALUATE_PRODUCT  = 3; //商品评论
    const   POINTS_TYPE_EVALUATE_STORE  = 6; //店铺评论
    const   POINTS_TYPE_CONSUME     = 4; //购买商品
    const   POINTS_TYPE_OTHER    = 5; //管理员操作
	const   POINTS_TYPE_EXCHANGE_PRODUCT = 7; //积分换购商品
	const   POINTS_TYPE_EXCHANGE_VOUCHER  = 8; //积分兑换优惠券
	const   POINTS_TYPE_EXCHANGE_SP  = 9; //积分兑换
	const   POINTS_TYPE_TRANSFER_MINUS  = 10; //积分转出
	const   POINTS_TYPE_TRANSFER_ADD  = 11; //积分转入
	const   POINTS_TYPE_CONSUME_RETRUN  = 12; //积分退还
	const   POINTS_TYPE_UP_SP  = 13; //升级服务商
	const   POINTS_TYPE_UP_SELLER  = 14; //升级商家

}
?>

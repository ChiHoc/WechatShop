<?php
/**
 * Created by PhpStorm.
 * User: ChiHo
 * Date: 2017/4/6
 * Time: 14:51
 */

namespace CHWechatShop;

class CHWechatShopConst
{
    // =========== 快递类型 =============
    // 平邮id
    const DELIVERY_TYPE_ID_MAIL = '10000027';
    // 快递id
    const DELIVERY_TYPE_ID_EXPRESS = '10000028';
    // EMSid
    const DELIVERY_TYPE_ID_EMS = '10000029';

    // =========== 商品上下架 =============
    // 商品上架
    const PRODUCT_SHELVE = 1;
    // 商品下架
    const PRODUCT_UNSHELVE = 0;

    // =========== 运费承担 =============
    // 买家承担运费
    const ASSUMER_BUYER = 0;
    // 卖家承担运费
    const ASSUMER_SELLER = 1;

    // =========== 是否包邮 =============
    // 邮递收费
    const NOT_POST_FREE = 0;
    // 包邮
    const POST_FREE = 1;

    // =========== 是否有收据 =============
    // 没有收据
    const NOT_HAS_RECEIPT = 0;
    // 有收据
    const HAS_RECEIPT = 1;

    // =========== 是否保修 =============
    // 不保修
    const NOT_UNDER_GUARANTY = 0;
    // 保修
    const UNDER_GUARANTY = 1;

    // =========== 是否可以退换 =============
    // 不可退换
    const NOT_SUPPORT_REPLACE = 0;
    // 可退换
    const SUPPORT_REPLACE = 1;

    // =========== 商品到分组 =============
    // 添加
    const GROUP_PRODUCT_ADD = 1;
    // 删除
    const GROUP_PRODUCT_REMOVE = 0;

    // =========== 快递公司id =============
    // 邮政EMS
    const EXPRESS_ID_EMS = 'Fsearch_code';
    // 申通快递
    const EXPRESS_ID_SHENTONG = '002shentong';
    // 中通速递
    const EXPRESS_ID_ZHONGTONG = '066zhongtong';
    // 圆通速递
    const EXPRESS_ID_YUANTONG = '056yuantong';
    // 天天快递
    const EXPRESS_ID_TIANTIAN = '042tiantian';
    // 顺丰速运
    const EXPRESS_ID_SHUNFENG = '003shunfeng';
    // 韵达快运
    const EXPRESS_ID_YUNDA = '059Yunda';
    // 宅急送
    const EXPRESS_ID_ZHAIJISONG = '064zhaijisong';
    // 汇通快运
    const EXPRESS_ID_HUITONG = '020huitong';
    // 易迅快递
    const EXPRESS_ID_YIXUN = 'zj001yixun';

    // =========== 是否需要物流 =============
    // 需要
    const NEED_DELIVERY = 1;
    // 不需要
    const NOT_NEED_DELIVERY = 0;

    // =========== 是否其他物流公司 =============
    // 是
    const IS_OTHERS_DELIVERY_COMPANY = 1;
    // 不是
    const NOT_OTHERS_DELIVERY_COMPANY = 0;

    // =========== 订单状态 =============
    // 全部状态
    const ORDER_STATUS_ALL = 1;
    // 待发货
    const ORDER_STATUS_TO_SEND = 2;
    // 已发货
    const ORDER_STATUS_SENT = 3;
    // 已完成
    const ORDER_STATUS_DONE = 5;
    // 已关闭
    const ORDER_STATUS_CLOSE = 6;
    // 维权中
    const ORDER_STATUS_COMPLAINT = 8;

    // =========== 运费模版 =============
    // 自定义运费模版
    const DELIVERY_TEMPLATE_TYPE_CUSTOM = 0;
    // 指定运费模版
    const DELIVERY_TEMPLATE_TYPE_TEMPLATE = 1;
}
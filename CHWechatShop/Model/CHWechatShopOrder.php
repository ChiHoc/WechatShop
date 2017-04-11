<?php
/**
 * Created by PhpStorm.
 * User: ChiHo
 * Date: 2017/4/7
 * Time: 21:02
 */

namespace CHWechatShop\Model;


class CHWechatShopOrder implements \JsonSerializable {

    // 订单ID
    const ORDER_ID = 'order_id';
    // 订单状态
    const ORDER_STATUS = 'order_status';
    // 订单总价格(单位 : 分)
    const ORDER_TOTAL_PRICE = 'order_total_price';
    // 订单创建时间
    const ORDER_CREATE_TIME = 'order_create_time';
    // 订单运费价格(单位 : 分)
    const ORDER_EXPRESS_PRICE = 'order_express_price';
    // 买家微信OPENID
    const BUYER_OPENID = 'buyer_openid';
    // 买家微信昵称
    const BUYER_NICK = 'buyer_nick';
    // 收货人姓名
    const RECEIVER_NAME = 'receiver_name';
    // 收货地址省份
    const RECEIVER_PROVINCE = 'receiver_province';
    // 收货地址城市
    const RECEIVER_CITY = 'receiver_city';
    // 收货地址区/县
    const RECEIVER_ZONE = 'receiver_zone';
    // 收货详细地址
    const RECEIVER_ADDRESS = 'receiver_address';
    // 收货人移动电话
    const RECEIVER_MOBILE = 'receiver_mobile';
    // 收货人固定电话
    const RECEIVER_PHONE = 'receiver_phone';
    // 商品ID
    const PRODUCT_ID = 'product_id';
    // 商品名称
    const PRODUCT_NAME = 'product_name';
    // 商品价格(单位 : 分)
    const PRODUCT_PRICE = 'product_price';
    // 商品SKU
    const PRODUCT_SKU = 'product_sku';
    // 商品个数
    const PRODUCT_COUNT = 'product_count';
    // 商品图片
    const PRODUCT_IMG = 'product_img';
    // 运单ID
    const DELIVERY_ID = 'delivery_id';
    // 物流公司编码
    const DELIVERY_COMPANY = 'delivery_company';
    // 交易ID
    const TRANS_ID = 'trans_id';

    protected $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function __toString() {
        return json_encode($this->getArray(), JSON_UNESCAPED_UNICODE);
    }

    public function jsonSerialize() {
        return $this->getArray();
    }

    protected function getArray() {
        $dataArray = array();
        return $dataArray;
    }

    // 获取订单ID
    public function getOrderId() {
        if (isset($this->data[self::ORDER_ID])) {
            return $this->data[self::ORDER_ID];
        }
        return null;
    }

    // 获取订单状态
    public function getOrderStatus() {
        if (isset($this->data[self::ORDER_STATUS])) {
            return $this->data[self::ORDER_STATUS];
        }
        return null;
    }

    // 获取订单总价格(单位 : 分)
    public function getOrderTotalPrice() {
        if (isset($this->data[self::ORDER_TOTAL_PRICE])) {
            return $this->data[self::ORDER_TOTAL_PRICE];
        }
        return null;
    }

    // 获取订单创建时间
    public function getOrderCreateTime() {
        if (isset($this->data[self::ORDER_CREATE_TIME])) {
            return $this->data[self::ORDER_CREATE_TIME];
        }
        return null;
    }

    // 获取订单运费价格(单位 : 分)
    public function getOrderExpressPrice() {
        if (isset($this->data[self::ORDER_EXPRESS_PRICE])) {
            return $this->data[self::ORDER_EXPRESS_PRICE];
        }
        return null;
    }

    // 获取买家微信OPENID
    public function getBuyerOpenid() {
        if (isset($this->data[self::BUYER_OPENID])) {
            return $this->data[self::BUYER_OPENID];
        }
        return null;
    }

    // 获取买家微信昵称
    public function getBuyerNick() {
        if (isset($this->data[self::BUYER_NICK])) {
            return $this->data[self::BUYER_NICK];
        }
        return null;
    }

    // 获取收货人姓名
    public function getReceiverName() {
        if (isset($this->data[self::RECEIVER_NAME])) {
            return $this->data[self::RECEIVER_NAME];
        }
        return null;
    }

    // 获取收货地址省份
    public function getReceiverProvince() {
        if (isset($this->data[self::RECEIVER_PROVINCE])) {
            return $this->data[self::RECEIVER_PROVINCE];
        }
        return null;
    }

    // 获取收货地址城市
    public function getReceiverCity() {
        if (isset($this->data[self::RECEIVER_CITY])) {
            return $this->data[self::RECEIVER_CITY];
        }
        return null;
    }

    // 获取收货地址区/县
    public function getReceiverZone() {
        if (isset($this->data[self::RECEIVER_ZONE])) {
            return $this->data[self::RECEIVER_ZONE];
        }
        return null;
    }

    // 获取收货详细地址
    public function getReceiverAddress() {
        if (isset($this->data[self::RECEIVER_ADDRESS])) {
            return $this->data[self::RECEIVER_ADDRESS];
        }
        return null;
    }

    // 获取收货人移动电话
    public function getReceiverMobile() {
        if (isset($this->data[self::RECEIVER_MOBILE])) {
            return $this->data[self::RECEIVER_MOBILE];
        }
        return null;
    }

    // 获取收货人固定电话
    public function getReceiverPhone() {
        if (isset($this->data[self::RECEIVER_PHONE])) {
            return $this->data[self::RECEIVER_PHONE];
        }
        return null;
    }

    // 获取商品ID
    public function getProductId() {
        if (isset($this->data[self::PRODUCT_ID])) {
            return $this->data[self::PRODUCT_ID];
        }
        return null;
    }

    // 获取商品名称
    public function getProductName() {
        if (isset($this->data[self::PRODUCT_NAME])) {
            return $this->data[self::PRODUCT_NAME];
        }
        return null;
    }

    // 获取商品价格(单位 : 分)
    public function getProductPrice() {
        if (isset($this->data[self::PRODUCT_PRICE])) {
            return $this->data[self::PRODUCT_PRICE];
        }
        return null;
    }

    // 获取商品SKU
    public function getProductSku() {
        if (isset($this->data[self::PRODUCT_SKU])) {
            return $this->data[self::PRODUCT_SKU];
        }
        return null;
    }

    // 获取商品个数
    public function getProductCount() {
        if (isset($this->data[self::PRODUCT_COUNT])) {
            return $this->data[self::PRODUCT_COUNT];
        }
        return null;
    }

    // 获取商品图片
    public function getProductImg() {
        if (isset($this->data[self::PRODUCT_IMG])) {
            return $this->data[self::PRODUCT_IMG];
        }
        return null;
    }

    // 获取运单ID
    public function getDeliveryId() {
        if (isset($this->data[self::DELIVERY_ID])) {
            return $this->data[self::DELIVERY_ID];
        }
        return null;
    }

    // 获取物流公司编码
    public function getDeliveryCompany() {
        if (isset($this->data[self::DELIVERY_COMPANY])) {
            return $this->data[self::DELIVERY_COMPANY];
        }
        return null;
    }

    // 获取交易ID
    public function getTransId() {
        if (isset($this->data[self::TRANS_ID])) {
            return $this->data[self::TRANS_ID];
        }
        return null;
    }

}
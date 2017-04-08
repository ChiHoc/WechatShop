<?php
/**
 * Created by PhpStorm.
 * User: ChiHo
 * Date: 2017/4/7
 * Time: 20:33
 */

namespace CHWechatShop\Model;

use CHWechatShop\CHWechatShopConst;

class CHWechatShopDelivery implements \JsonSerializable {

    // 订单id
    const ORDER_ID = 'order_id';
    // 物流公司id
    const DELIVERY_COMPANY = 'delivery_company';
    // 运单id
    const DELIVERY_TRACK_NO = 'delivery_track_no';
    // 是否需要物流
    const NEED_DELIVERY = 'need_delivery';
    // 是否其他物流
    const IS_OTHERS = 'is_others';

    protected $orderId;
    protected $deliveryCompany;
    protected $deliveryTrackNo;
    protected $needDelivery;
    protected $isOthers;

    public function __construct() {
        $this->needDelivery = CHWechatShopConst::NEED_DELIVERY;
        $this->isOthers = CHWechatShopConst::NOT_OTHERS_DELIVERY_COMPANY;
    }

    public function __toString() {
        return json_encode($this->getArray(), JSON_UNESCAPED_UNICODE);
    }

    public function jsonSerialize() {
        return $this->getArray();
    }

    protected function getArray() {
        $dataArray = array();
        $dataArray[self::NEED_DELIVERY] = $this->needDelivery;
        $dataArray[self::IS_OTHERS] = $this->isOthers;
        if (isset($this->orderId)) {
            $dataArray[self::ORDER_ID] = $this->orderId;
        }
        if (isset($this->deliveryCompany)) {
            $dataArray[self::DELIVERY_COMPANY] = $this->deliveryCompany;
        }
        if (isset($this->deliveryTrackNo)) {
            $dataArray[self::DELIVERY_TRACK_NO] = $this->deliveryTrackNo;
        }
        return $dataArray;
    }

    /**
     * 获取订单id
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * 设置订单id
     * @param string $orderId
     * @return CHWechatShopDelivery
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
        return $this;
    }

    /**
     * 获取物流公司id
     * @return string
     */
    public function getDeliveryCompany()
    {
        return $this->deliveryCompany;
    }

    /**
     * 设置物流公司id(不用物流可不填, 若使用其他物流则直接写名字)
     * @param string $deliveryCompany
     * @return CHWechatShopDelivery
     */
    public function setDeliveryCompany($deliveryCompany)
    {
        $this->deliveryCompany = $deliveryCompany;
        return $this;
    }

    /**
     * 获取运单id
     * @return string
     */
    public function getDeliveryTrackNo()
    {
        return $this->deliveryTrackNo;
    }

    /**
     * 设置运单id(不用物流可不填)
     * @param string $deliveryTrackNo
     * @return CHWechatShopDelivery
     */
    public function setDeliveryTrackNo($deliveryTrackNo)
    {
        $this->deliveryTrackNo = $deliveryTrackNo;
        return $this;
    }

    /**
     * 获取是否需要物流
     * @return int
     */
    public function getNeedDelivery()
    {
        return $this->needDelivery;
    }

    /**
     * 设置是否需要物流
     * @param int $needDelivery
     * @return CHWechatShopDelivery
     */
    public function setNeedDelivery($needDelivery)
    {
        $this->needDelivery = $needDelivery;
        return $this;
    }

    /**
     * 获取是否其他物流公司
     * @return int
     */
    public function getIsOthers()
    {
        return $this->isOthers;
    }

    /**
     * 设置是否其他物流公司
     * @param int $isOthers
     * @return CHWechatShopDelivery
     */
    public function setIsOthers($isOthers)
    {
        $this->isOthers = $isOthers;
        return $this;
    }
}
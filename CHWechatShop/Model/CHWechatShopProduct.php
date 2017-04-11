<?php
namespace CHWechatShop\Model;

use CHWechatShop\CHWechatShopConst;

/**
 * Created by PhpStorm.
 * User: ChiHo
 * Date: 2017/4/1
 * Time: 16:14
 */
class CHWechatShopProduct implements \JsonSerializable
{
    // 商品id
    const PRODUCT_ID = 'product_id';
    // 上架状态
    const STATUS = 'status';

    // ========= 商品基本属性 ==========
    const BASE_ATTR = 'product_base';
    // 商品名
    const NAME = 'name';
    // 商品分类id
    const CATEGORY_ID= 'category_id';
    // 商品主图
    const MAIN_IMAGE = 'main_img';
    // 商品图片列表
    const IMAGE_LIST= 'img';

    // 商品详情列表
    const DETAIL = 'detail';
    // 文字描述
    const DETAIL_TEXT = 'text';
    // 图片描述
    const DETAIL_IMAGE = 'img';

    // 商品属性列表
    const PROPERTY = 'property';
    // 属性id
    const PROPERTY_ID = 'id';
    // 属性值id
    const PROPERTY_VID = 'vid';

    // 商品详情列表
    const SKU_INFO = 'sku_info';
    // sku属性
    const SKU_INFO_ID = 'id';
    // sku值
    const SKU_INFO_VID = 'vid';

    // 用户商品限购数量
    const BUY_LIMIT = 'buy_limit';

    // ========= SKU(stock keeping unit)(库存量单位)信息列表 ==========
    const SKU_LIST = 'sku_list';
    // sku信息
    const SKU_ID = 'sku_id';
    // sku原价
    const ORI_PRICE = 'ori_price';
    // sku微信价
    const PRICE = 'price';
    // sku iconurl
    const ICON_URL = 'icon_url';
    // sku库存
    const QUANTITY = 'quantity';
    // 商家商品编码
    const PRODUCT_CODE = 'product_code';

    // ========= 商品其他属性 ==========
    const ATTREXT = 'attrext';
    // 是否包邮
    const IS_POST_FREE = 'isPostFree';
    // 是否提供发票
    const IS_HAS_RECEIPT = 'isHasReceipt';
    // 是否保修
    const IS_UNDER_GUARANTY = 'isUnderGuaranty';
    // 是否支持退换货
    const IS_SUPPORT_REPLACE = 'isSupportReplace';

    // ========= 运费信息 ==========
    const DELIVERY_INFO = 'delivery_info';
    // 运费类型
    const DELIVERY_TYPE = 'delivery_type';
    // 邮费模板ID
    const TEMPLATE_ID = 'template_id';
    // 快递信息
    const EXPRESS = 'express';
    // 快递ID
    const EXPRESS_ID = 'id';
    // 运费(单位 : 分)
    const EXPRESS_PRICE = 'price';

    protected $productId;
    protected $status;
    protected $baseAttrData;
    protected $skuListData;
    protected $attrExtData;
    protected $deliveryInfoData;

    public function __construct($data=null) {
        if ($data == null) {
            $this->baseAttrData = array();
            $this->baseAttrData[self::CATEGORY_ID] = array();
            $this->baseAttrData[self::IMAGE_LIST] = array();
            $this->baseAttrData[self::DETAIL] = array();
            $this->baseAttrData[self::PROPERTY] = array();
            $this->baseAttrData[self::SKU_INFO] = array();

            $this->skuListData = array();

            $this->attrExtData = array();
            $this->attrExtData[self::IS_POST_FREE] = 1;
            $this->attrExtData[self::IS_HAS_RECEIPT] = 0;
            $this->attrExtData[self::IS_UNDER_GUARANTY] = 0;
            $this->attrExtData[self::IS_SUPPORT_REPLACE] = 0;

            $this->deliveryInfoData = array();
            $this->deliveryInfoData[self::EXPRESS] = array();
        } else {
            if (isset($data[self::PRODUCT_ID])) {
                $this->productId = $data[self::PRODUCT_ID];
            }
            if (isset($data[self::STATUS])) {
                $this->status = $data[self::STATUS];
            }
            if (isset($data[self::BASE_ATTR])) {
                $this->baseAttrData = $data[self::BASE_ATTR];
            }
            if (isset($data[self::ATTREXT])) {
                $this->attrExtData = $data[self::ATTREXT];
            }
        }
    }

    public function __toString() {
        return json_encode($this->getArray(), JSON_UNESCAPED_UNICODE);
    }

    public function jsonSerialize() {
        return $this->getArray();
    }

    protected function getArray() {
        $dataArray = array();
        $dataArray[self::BASE_ATTR] = $this->baseAttrData;
        $dataArray[self::SKU_LIST] = $this->skuListData;
        $dataArray[self::ATTREXT] = $this->attrExtData;
        $dataArray[self::DELIVERY_INFO] = $this->deliveryInfoData;
        if (isset($this->productId)) {
            $dataArray[self::PRODUCT_ID] = $this->productId;
        }
        if (isset($this->status)) {
            $dataArray[self::STATUS] = $this->status;
        }
        return $dataArray;
    }

    /**
     * 获取商品id
     * @return string
     */
    public function getProductId() {
        return $this->productId;
    }

    /**
     * 获取商品上架状态
     * @return int
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * 设置商品名
     * @param $name string
     * @return $this
     */
    public function setName($name) {
        if (empty($name)) {
            throw new \RuntimeException('Name invalid!');
        }
        $this->baseAttrData[self::NAME] = $name;
        return $this;
    }

    /**
     * 获取商品名
     * @return string
     */
    public function getName() {
        if (isset($this->baseAttrData[self::NAME])) {
            return $this->baseAttrData[self::NAME];
        }
        return null;
    }

    /**
     * 设置分类id
     * @param $id string
     * @return $this
     */
    public function setCategoryId($id) {
        if (empty($id)) {
            throw new \RuntimeException('Id invalid!');
        }
        $this->baseAttrData[self::CATEGORY_ID][] = $id;
        return $this;
    }

    /**
     * 获取分类id
     * @return string
     */
    public function getCategoryId() {
        if (count($this->baseAttrData[self::CATEGORY_ID])) {
            return $this->baseAttrData[self::CATEGORY_ID][0];
        }
        return null;
    }

    /**
     * 设置商品主图
     * @param $mainImageUri string
     * @return $this
     */
    public function setMainImage($mainImageUri) {
        if (!filter_var($mainImageUri, FILTER_VALIDATE_URL)) {
            throw new \RuntimeException('ImageUri invalid!');
        }
        $this->baseAttrData[self::MAIN_IMAGE] = $mainImageUri;
        return $this;
    }

    /**
     * 获取商品主图
     * @return string
     */
    public function getMainImage() {
        if (isset($this->baseAttrData[self::MAIN_IMAGE])) {
            return $this->baseAttrData[self::MAIN_IMAGE];
        }
        return null;
    }

    /**
     * 删除全部介绍图
     * @return $this
     */
    public function removeImage() {
        $this->baseAttrData[self::IMAGE_LIST] = array();
        return $this;
    }

    /**
     * 添加介绍图
     * @param $imageUri string
     * @return $this
     */
    public function addImage($imageUri) {
        if (!filter_var($imageUri, FILTER_VALIDATE_URL)) {
            throw new \RuntimeException('ImageUri invalid!');
        }
        $this->baseAttrData[self::IMAGE_LIST][] = $imageUri;
        return $this;
    }

    /**
     * 获取所有介绍图
     * @return array
     */
    public function getImage() {
        if (count($this->baseAttrData[self::MAIN_IMAGE])) {
            return $this->baseAttrData[self::MAIN_IMAGE];
        }
        return null;
    }

    /**
     * 删除详情介绍
     * @return $this
     */
    public function removeDetail() {
        $this->baseAttrData[self::DETAIL] = array();
        return $this;
    }

    /**
     * 添加文字详情介绍
     * @param $content string
     * @return $this
     */
    public function addDetailText($content) {
        if (empty($content)) {
            throw new \RuntimeException('Content invalid!');
        }
        $this->baseAttrData[self::DETAIL][] = array(self::DETAIL_TEXT => $content);
        return $this;
    }

    /**
     * 添加图片详情介绍
     * @param $imageUri string
     * @return $this
     */
    public function addDetailImage($imageUri) {
        if (!filter_var($imageUri, FILTER_VALIDATE_URL)) {
            throw new \RuntimeException('ImageUri invalid!');
        }
        $this->baseAttrData[self::DETAIL][] = array(self::DETAIL_IMAGE => $imageUri);
        return $this;
    }

    /**
     * 获取详情介绍
     * @return array
     */
    public function getDetail() {
        if (count($this->baseAttrData[self::DETAIL])) {
            return $this->baseAttrData[self::DETAIL];
        }
        return null;
    }

    /**
     * 删除属性
     * @return $this
     */
    public function removeProperty() {
        $this->baseAttrData[self::PROPERTY] = array();
        return $this;
    }

    /**
     * 添加属性
     * @param $propertyId string
     * @param $propertyVid string
     * @return $this
     */
    public function addProperty($propertyId, $propertyVid) {
        if (empty($propertyId)) {
            throw new \RuntimeException('PropertyId invalid!');
        }
        if (empty($propertyVid)) {
            throw new \RuntimeException('PropertyVid invalid!');
        }
        $this->baseAttrData[self::PROPERTY][] = array(self::PROPERTY_ID => $propertyId, self::PROPERTY_VID => $propertyVid);
        return $this;
    }

    /**
     * 获取详情介绍
     * @return array
     */
    public function getProperty() {
        if (count($this->baseAttrData[self::PROPERTY])) {
            return $this->baseAttrData[self::PROPERTY];
        }
        return null;
    }

    /**
     * 添加商品sku定义
     * @param $skuInfoId string
     * @param $skuInfoVid string
     * @return $this
     */
    private function addSkuInfo($skuInfoId, $skuInfoVid) {
        if (empty($skuInfoId)) {
            throw new \RuntimeException('SkuInfoId invalid!');
        }
        if (empty($skuInfoVid)) {
            throw new \RuntimeException('SkuInfoVid invalid!');
        }
        foreach ($this->skuListData as $skuList) {
            if ($skuList[self::SKU_INFO_ID] == $skuInfoId) {
                $skuList[self::SKU_INFO_VID][] = $skuInfoVid;
                return $this;
            }
        }
        $this->baseAttrData[self::SKU_INFO][] = array(self::SKU_INFO_ID => $skuInfoId, self::SKU_INFO_VID => array($skuInfoVid));
        return $this;
    }

    /**
     * 获取商品sku定义
     * @return array
     */
    public function getSkuInfo() {
        if (count($this->baseAttrData[self::SKU_INFO])) {
            return $this->baseAttrData[self::SKU_INFO];
        }
        return null;
    }

    /**
     * 设置每人限购
     * @param $limit int
     * @return $this
     */
    public function setBuyLimit($limit) {
        if ($limit <= 0) {
            throw new \RuntimeException('Limit invalid!');
        }
        $this->baseAttrData[self::BUY_LIMIT] = $limit;
        return $this;
    }

    /**
     * 获取每人限购
     * @return int
     */
    public function getBuyLimit() {
        return $this->baseAttrData[self::BUY_LIMIT];
    }

    /**
     * 删除sku
     * @return $this
     */
    public function removeSku() {
        $this->baseAttrData[self::PROPERTY] = array();
        $this->skuListData = array();
        return $this;
    }

    /**
     * 添加SKU
     * @param $skuId string
     * @param $price int
     * @param $iconUrl string
     * @param $quantity int
     * @param null $oriPrice
     * @param null $productCode
     * @return $this
     */
    public function addSku($skuId, $price, $iconUrl, $quantity, $oriPrice=null, $productCode=null) {
        if (!filter_var($iconUrl, FILTER_VALIDATE_URL)) {
            throw new \RuntimeException('IconUrl invalid!');
        }
        if ($price < 0) {
            throw new \RuntimeException('Price invalid!');
        }
        if ($quantity < 0) {
            throw new \RuntimeException('Quantity invalid!');
        }
        if ($oriPrice != null && $price > $oriPrice) {
            throw new \RuntimeException('OriPrice invalid!');
        }
        if (!empty($skuId)) {
            $skuIdAry = explode(':', $skuId);
            if (count($skuIdAry) != 2) {
                throw new \RuntimeException('SkuId invalid!');
            }
            $this->addSkuInfo($skuIdAry[0], $skuIdAry[1]);
        }
        $this->skuListData[] = array(
            self::SKU_ID => $skuId ?: '',
            self::PRICE => $price,
            self::ICON_URL => $iconUrl,
            self::QUANTITY => $quantity,
            self::ORI_PRICE => $oriPrice ?: '',
            self::PRODUCT_CODE => $productCode ?: '');
        return $this;
    }

    /**
     * 获取sku
     * @return array|null
     */
    public function getSku() {
        if (count($this->skuListData)) {
            return $this->skuListData;
        }
        return null;
    }

    /**
     * 设置是否包邮
     * @param $isPostFree int
     * @return $this
     */
    public function setPostFree($isPostFree) {
        if ($isPostFree != CHWechatShopConst::POST_FREE && $isPostFree != CHWechatShopConst::NOT_POST_FREE) {
            throw new \RuntimeException('PostFree invalid!');
        }
        $this->attrExtData[self::IS_POST_FREE] = $isPostFree;
        return $this;
    }

    /**
     * 获取是否包邮
     * @return int
     */
    public function getPostFree() {
        return $this->attrExtData[self::IS_POST_FREE];
    }

    /**
     * 设置是否有收据
     * @param $isHasReceipt int
     * @return $this
     */
    public function setHasReceipt($isHasReceipt) {
        if ($isHasReceipt != CHWechatShopConst::HAS_RECEIPT && $isHasReceipt != CHWechatShopConst::NOT_HAS_RECEIPT) {
            throw new \RuntimeException('HasReceipt invalid!');
        }
        $this->attrExtData[self::IS_HAS_RECEIPT] = $isHasReceipt;
        return $this;
    }

    /**
     * 获取是否有收据
     * @return int
     */
    public function getHasReceipt() {
        return $this->attrExtData[self::IS_HAS_RECEIPT];
    }

    /**
     * 设置是否保修
     * @param $isUnderGuaranty int
     * @return $this
     */
    public function setUnderGuaranty($isUnderGuaranty) {
        if ($isUnderGuaranty != CHWechatShopConst::UNDER_GUARANTY && $isUnderGuaranty != CHWechatShopConst::NOT_UNDER_GUARANTY) {
            throw new \RuntimeException('UnderGuaranty invalid!');
        }
        $this->attrExtData[self::IS_UNDER_GUARANTY] = $isUnderGuaranty;
        return $this;
    }

    /**
     * 获取是否保修
     * @return int
     */
    public function getUnderGuaranty() {
        return $this->attrExtData[self::IS_UNDER_GUARANTY];
    }

    /**
     * 设置是否退换
     * @param $isSupportReplace int
     * @return $this
     */
    public function setSupportReplace($isSupportReplace) {
        if ($isSupportReplace != CHWechatShopConst::SUPPORT_REPLACE && $isSupportReplace != CHWechatShopConst::NOT_SUPPORT_REPLACE) {
            throw new \RuntimeException('SupportReplace invalid!');
        }
        $this->attrExtData[self::IS_SUPPORT_REPLACE] = $isSupportReplace;
        return $this;
    }

    /**
     * 获取是否退换
     * @return int
     */
    public function getSupportReplace() {
        return $this->attrExtData[self::IS_SUPPORT_REPLACE];
    }

    /**
     * 设置运费类型
     * @param $templateType
     * @return $this
     * @internal param int $deliveryType
     */
    private function setDeliveryTemplateType($templateType) {
        if ($templateType != CHWechatShopConst::DELIVERY_TEMPLATE_TYPE_CUSTOM && $templateType != CHWechatShopConst::DELIVERY_TEMPLATE_TYPE_TEMPLATE) {
            throw new \RuntimeException('TemplateType invalid!');
        }
        $this->deliveryInfoData[self::DELIVERY_TYPE] = $templateType;
        return $this;
    }

    /**
     * 设置运费模版(template和express只需要使用其中一种)
     * @param $templateId String
     * @return $this
     */
    public function setTemplateId($templateId) {
        $this->setDeliveryTemplateType(CHWechatShopConst::DELIVERY_TEMPLATE_TYPE_TEMPLATE);
        $this->deliveryInfoData[self::TEMPLATE_ID] = $templateId;
        return $this;
    }

    /**
     * 返回运费模版id
     * @return String
     */
    public function getTemplateId() {
        if (isset($this->deliveryInfoData[self::TEMPLATE_ID])) {
            return $this->deliveryInfoData[self::TEMPLATE_ID];
        }
        return null;
    }

    /**
     * 添加自定义运费(template和express只需要使用其中一种)
     * @param $deliveryType String
     * @param $price
     * @return $this
     */
    public function addCustomExpress($deliveryType, $price) {
        if ($deliveryType != CHWechatShopConst::DELIVERY_TYPE_ID_EMS && $deliveryType != CHWechatShopConst::DELIVERY_TYPE_ID_EXPRESS && $deliveryType != CHWechatShopConst::DELIVERY_TYPE_ID_MAIL) {
            throw new \RuntimeException('DeliveryType invalid!');
        }
        if ($price < 0) {
            throw new \RuntimeException('Price invalid!');
        }
        $this->setDeliveryTemplateType(CHWechatShopConst::DELIVERY_TEMPLATE_TYPE_CUSTOM);
        $this->deliveryInfoData[self::EXPRESS][] = array(self::EXPRESS_ID => $deliveryType, self::EXPRESS_PRICE => $price);
        return $this;
    }

    /**
     * 清楚自定义运费
     * @return $this
     */
    public function removeCustomExpresses() {
        $this->deliveryInfoData[self::EXPRESS] = array();
        return $this;
    }

    /**
     * 获取自定义运费
     * @return mixed
     */
    public function getCustomExpresses() {
        if (count($this->deliveryInfoData[self::EXPRESS])) {
            return $this->deliveryInfoData[self::EXPRESS];
        }
        return null;
    }
}
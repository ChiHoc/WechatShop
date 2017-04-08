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
    const DETAIL_TEXT = 'text';
    const DETAIL_IMAGE = 'img';
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

    protected $productId;
    protected $status;
    protected $baseAttrData;
    protected $attrExtData;

    public function __construct($data=null) {
        if ($data == null) {
            $this->baseAttrData = array();
            $this->baseAttrData[self::CATEGORY_ID] = array();
            $this->baseAttrData[self::IMAGE_LIST] = array();
            $this->baseAttrData[self::DETAIL] = array();

            $this->attrExtData = array();

            $this->attrExtData[self::IS_POST_FREE] = 1;
            $this->attrExtData[self::IS_HAS_RECEIPT] = 0;
            $this->attrExtData[self::IS_UNDER_GUARANTY] = 0;
            $this->attrExtData[self::IS_SUPPORT_REPLACE] = 0;
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
        $dataArray[self::ATTREXT] = $this->attrExtData;
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
        $this->baseAttrData[self::DETAIL][] = array(self::DETAIL_TEXT => $content);
        return $this;
    }

    /**
     * 添加图片详情介绍
     * @param $imageUri string
     * @return $this
     */
    public function addDetailImage($imageUri) {
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
     * 设置每人限购
     * @param $limit int
     * @return $this
     */
    public function setBuyLimit($limit) {
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
     * 设置是否包邮
     * @param $isPostFree int
     * @return $this
     */
    public function setPostFree($isPostFree) {
        if ($isPostFree == CHWechatShopConst::POST_FREE || $isPostFree == CHWechatShopConst::NOT_POST_FREE) {
            $this->baseAttrData[self::IS_POST_FREE] = $isPostFree;
        }
        return $this;
    }

    /**
     * 获取是否包邮
     * @return int
     */
    public function getPostFree() {
        return $this->baseAttrData[self::IS_POST_FREE];
    }

    /**
     * 设置是否有收据
     * @param $isHasReceipt int
     * @return $this
     */
    public function setHasReceipt($isHasReceipt) {
        if ($isHasReceipt == CHWechatShopConst::HAS_RECEIPT || $isHasReceipt == CHWechatShopConst::NOT_HAS_RECEIPT) {
            $this->baseAttrData[self::IS_HAS_RECEIPT] = $isHasReceipt;
        }
        return $this;
    }

    /**
     * 获取是否有收据
     * @return int
     */
    public function getHasReceipt() {
        return $this->baseAttrData[self::IS_HAS_RECEIPT];
    }

    /**
     * 设置是否保修
     * @param $isUnderGuaranty int
     * @return $this
     */
    public function setUnderGuaranty($isUnderGuaranty) {
        if ($isUnderGuaranty == CHWechatShopConst::UNDER_GUARANTY || $isUnderGuaranty == CHWechatShopConst::NOT_UNDER_GUARANTY) {
            $this->baseAttrData[self::IS_UNDER_GUARANTY] = $isUnderGuaranty;
        }
        return $this;
    }

    /**
     * 获取是否保修
     * @return int
     */
    public function getUnderGuaranty() {
        return $this->baseAttrData[self::IS_UNDER_GUARANTY];
    }

    /**
     * 设置是否退换
     * @param $isSupportReplace int
     * @return $this
     */
    public function setSupportReplace($isSupportReplace) {
        if ($isSupportReplace == CHWechatShopConst::SUPPORT_REPLACE || $isSupportReplace == CHWechatShopConst::NOT_SUPPORT_REPLACE) {
            $this->baseAttrData[self::IS_SUPPORT_REPLACE] = $isSupportReplace;
        }
        return $this;
    }

    /**
     * 获取是否退换
     * @return int
     */
    public function getSupportReplace() {
        return $this->baseAttrData[self::IS_SUPPORT_REPLACE];
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: ChiHo
 * Date: 2017/4/7
 * Time: 11:15
 */

namespace CHWechatShop\Model;


class CHWechatShopGroup implements \JsonSerializable
{
    // 分组id
    const GROUP_ID = 'group_id';
    // 分组名字
    const GROUP_NAME = 'group_name';
    // 分组产品列表
    const PRODUCT_LIST = 'product_list';

    protected $groupId;
    protected $groupName;
    protected $productList;

    public function __construct($data=null) {
        if ($data == null) {
            $this->productList = array();
        } else {
            if (isset($data[self::GROUP_ID])) {
                $this->groupId = $data[self::GROUP_ID];
            }
            if (isset($data[self::GROUP_NAME])) {
                $this->groupName = $data[self::GROUP_NAME];
            }
            if (isset($data[self::PRODUCT_LIST])) {
                $this->productList = $data[self::PRODUCT_LIST];
            }
        }
    }

    public function __toString() {
        return json_encode($this->getArray(), JSON_UNESCAPED_UNICODE);
    }

    public function jsonSerialize() {
        return $this->getArray();
    }

    private function getArray() {
        $dataArray = array();
        $dataArray[self::PRODUCT_LIST] = $this->productList;
        if (isset($this->groupName)) {
            $dataArray[self::GROUP_NAME] = $this->groupName;
        }
        if (isset($this->groupId)) {
            $dataArray[self::GROUP_ID] = $this->groupId;
        }
        return $dataArray;
    }

    /**
     * 获取分组id
     * @return string
     */
    public function getGroupId() {
        return $this->groupId;
    }

    /**
     * 获取分组名
     * @return string
     */
    public function getGroupName() {
        return $this->groupName;
    }

    /**
     * 设置分组名
     * @param string $groupName
     * @return CHWechatShopGroup
     */
    public function setGroupName($groupName) {
        $this->groupName = $groupName;
        return $this;
    }

    /**
     * 获取商品列表
     * @return array
     */
    public function getProductList() {
        return $this->productList;
    }

    /**
     * 删除商品列表
     * @return CHWechatShopGroup
     */
    public function removeProductList() {
        $this->productList = array();
        return $this;
    }

    /**
     * 添加商品
     * @return CHWechatShopGroup
     */
    public function addProduct($productId) {
        $this->productList[] = $productId;
        return $this;
    }
}

class CHWechatShopGroupModify implements \JsonSerializable {

    // 产品id
    const PRODUCT_ID = 'product_id';
    // 行为
    const MOD_ACTION = 'mod_action';

    protected $productId;
    protected $modAction;

    /**
     * CHWechatShopGroupModify constructor.
     * @param $productId string
     * @param $action string
     */
    public function __construct($productId, $action) {
        $this->productId = $productId;
        $this->modAction = $action;
    }

    public function __toString() {
        return json_encode($this->getArray(), JSON_UNESCAPED_UNICODE);
    }

    public function jsonSerialize() {
        return $this->getArray();
    }

    protected function getArray() {
        $dataArray = array();
        if (isset($this->productId)) {
            $dataArray[self::PRODUCT_ID] = $this->productId;
        }
        if (isset($this->modAction)) {
            $dataArray[self::MOD_ACTION] = $this->modAction;
        }
        return $dataArray;
    }
}
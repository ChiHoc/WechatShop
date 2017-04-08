<?php
/**
 * Created by PhpStorm.
 * User: ChiHo
 * Date: 2017/4/7
 * Time: 20:30
 */

namespace CHWechatShop\Model;


class CHWechatShopShelf implements \JsonSerializable {

    // 货架id
    const SHELF_ID = 'shelf_id';
    // 货架信息
    const SHELF_DATA = 'shelf_data';
    // 货架招牌图片
    const SHELF_BANNER = 'shelf_banner';
    // 货架名称
    const SHELF_NAME = 'shelf_name';
    // 货架模块
    const MODULE_INFOS = 'module_infos';

    protected $shelfId;
    protected $shelfData;
    protected $shelfBanner;
    protected $shelfName;

    /**
     * 创建货架对象
     * @param $data array
     * @return null|CHWechatShopShelfData1|CHWechatShopShelfData2|CHWechatShopShelfData3|CHWechatShopShelfData4
     */
    protected static function createShelfData($data) {
        if (isset($data[CHWechatShopShelfBaseData::EID])) {
            switch ($data[CHWechatShopShelfBaseData::EID]) {
                case 1: {
                    return new CHWechatShopShelfData1($data);
                }
                case 2: {
                    return new CHWechatShopShelfData2($data);
                }
                case 3: {
                    return new CHWechatShopShelfData3($data);
                }
                case 4: {
                    return new CHWechatShopShelfData4($data);
                }
            }
        }
        return null;
    }

    public function __construct($data=null) {
        $this->shelfData = array();
        if ($data != null) {
            if (isset($data[self::MODULE_INFOS])) {
                foreach ($data[self::MODULE_INFOS] as $dataAry) {
                    $this->shelfData[] = self::createShelfData($dataAry);
                }
            }
            if (isset($data[self::SHELF_NAME])) {
                $this->shelfName = $data[self::SHELF_NAME];
            }
            if (isset($data[self::SHELF_BANNER])) {
                $this->shelfBanner = $data[self::SHELF_BANNER];
            }
            if (isset($data[self::SHELF_ID])) {
                $this->shelfId = $data[self::SHELF_ID];
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
        $dataArray[self::SHELF_DATA] = array(self::MODULE_INFOS => $this->shelfData);
        if (isset($this->shelfBanner)) {
            $dataArray[self::SHELF_BANNER] = $this->shelfBanner;
        }
        if (isset($this->shelfName)) {
            $dataArray[self::SHELF_NAME] = $this->shelfName;
        }
        if (isset($this->shelfId)) {
            $dataArray[self::SHELF_ID] = $this->shelfId;
        }
        return $dataArray;
    }

    /**
     * 获取货架内容
     * @return array
     */
    public function getShelfData()
    {
        return $this->shelfData;
    }

    /**
     * 清除货架内容
     * return CHWechatShopShelf
     */
    public function removeShelfData()
    {
        $this->shelfData = array();
        return $this;
    }

    /**
     * 添加货架内容
     * @param CHWechatShopShelfBaseData $shelfData
     * @return CHWechatShopShelf
     */
    public function addShelfData($shelfData)
    {
        $this->shelfData[] = $shelfData;
        return $this;
    }

    /**
     * 获取Banner图片地址
     * @return string
     */
    public function getShelfBanner()
    {
        return $this->shelfBanner;
    }

    /**
     * 设置Banner图片地址
     * @param string $shelfBanner
     * @return CHWechatShopShelf
     */
    public function setShelfBanner($shelfBanner)
    {
        $this->shelfBanner = $shelfBanner;
        return $this;
    }

    /**
     * 获取货架名字
     * @return string
     */
    public function getShelfName()
    {
        return $this->shelfName;
    }

    /**
     * 设置货架名字
     * @param string $shelfName
     * @return CHWechatShopShelf
     */
    public function setShelfName($shelfName)
    {
        $this->shelfName = $shelfName;
        return $this;
    }
}

class CHWechatShopShelfBaseData implements \JsonSerializable {

    const EID = 'eid';

    protected $shelfData;
    protected $eid;

    public function __construct($data=null) {
        if ($data == null) {
            $this->shelfData = array();
        } else {
            if (isset($data[self::EID])) {
                $this->eid = $data[self::EID];
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
        if (isset($this->eid)) {
            $dataArray[self::EID] = $this->eid;
        }
        return $dataArray;
    }

    /**
     * 获取eid
     * @return string
     */
    public function getEid()
    {
        return $this->eid;
    }
}

class CHWechatShopShelfData1 extends CHWechatShopShelfBaseData {

    // 分组信息
    const GROUP_INFO = 'group_info';
    const FILTER = 'filter';
    // 该控件展示商品个数
    const COUNT = 'count';
    // 分组ID
    const GROUP_ID = 'group_id';

    public function __construct($data=null)
    {
        parent::__construct($data);
        $this->eid = 1;
        if ($data == null) {
            $this->shelfData[self::FILTER][self::COUNT] = 1;
        } else {
            if (isset($data[self::GROUP_INFO])) {
                $this->shelfData = $data[self::GROUP_INFO];
            }
        }
    }

    protected function getArray() {
        $dataArray = parent::getArray();
        $dataArray[self::GROUP_INFO] = $this->shelfData;
        return $dataArray;
    }

    /**
     * 设置商品数量
     * @param $count int
     * @return CHWechatShopShelfData1
     */
    public function setProductCount($count) {
        $this->shelfData[self::FILTER] = array(self::COUNT => $count);
        return $this;
    }

    /**
     * 获取商品数量
     * @return $count int
     */
    public function getProductCount() {
        return $this->shelfData[self::FILTER][self::COUNT];
    }

    /**
     * 设置分组id
     * @param $groupId string
     * @return CHWechatShopShelfData1
     */
    public function setGroupId($groupId) {
        $this->shelfData[self::GROUP_ID] = $groupId;
        return $this;
    }

    /**
     * 获取分组id
     * @return $groupId string
     */
    public function getGroupId() {
        if (isset($this->shelfData[self::GROUP_ID])) {
            return $this->shelfData[self::GROUP_ID];
        }
        return null;
    }
}

class CHWechatShopShelfData2 extends CHWechatShopShelfBaseData {

    // 分组信息
    const GROUP_INFOS = 'group_infos';
    // 分组数组
    const GROUPS = 'groups';
    // 分组ID
    const GROUP_ID = 'group_id';

    public function __construct($data=null)
    {
        parent::__construct($data);
        $this->eid = 2;
        if ($data == null) {
            $this->shelfData[self::GROUPS] = array();
        } else {
            if (isset($data[self::GROUP_INFOS])) {
                $this->shelfData = $data[self::GROUP_INFOS];
            }
        }
    }

    protected function getArray() {
        $dataArray = parent::getArray();
        $dataArray[self::GROUP_INFOS] = $this->shelfData;
        return $dataArray;
    }

    /**
     * 清除分组
     * @return CHWechatShopShelfData2
     */
    public function removeGroups() {
        $this->shelfData[self::GROUPS] = array();
        return $this;
    }

    /**
     * 添加分组
     * @param $groupId string
     * @return CHWechatShopShelfData2
     */
    public function addGroup($groupId) {
        if (count($this->shelfData[self::GROUPS]) < 4) {
            $this->shelfData[self::GROUPS][] = array(self::GROUP_ID => $groupId);
        }
        return $this;
    }
}

class CHWechatShopShelfData3 extends CHWechatShopShelfBaseData {

    // 分组信息
    const GROUP_INFO = 'group_info';
    // 图片
    const IMG = 'img';
    // 分组ID
    const GROUP_ID = 'group_id';

    public function __construct($data=null)
    {
        parent::__construct($data);
        $this->eid = 3;
        if ($data != null && isset($data[self::GROUP_INFO])) {
            $this->shelfData = $data[self::GROUP_INFO];
        }
    }

    protected function getArray() {
        $dataArray = parent::getArray();
        $dataArray[self::GROUP_INFO] = $this->shelfData;
        return $dataArray;
    }

    /**
     * 获取分组id
     * @return int
     */
    public function getGroupId() {
        if (isset($this->shelfData[self::GROUP_ID])) {
            return $this->shelfData[self::GROUP_ID];
        }
        return null;
    }

    /**
     * 设置分组id
     * @param $groupId string
     * @return CHWechatShopShelfData3
     */
    public function setGroupId($groupId) {
        $this->shelfData[self::GROUP_ID] = $groupId;
        return $this;
    }

    /**
     * 获取图片地址
     * @return int
     */
    public function getImage() {
        if (isset($this->shelfData[self::IMG])) {
            return $this->shelfData[self::IMG];
        }
        return null;
    }

    /**
     * 设置图片地址
     * @param $imageUrl string
     * @return CHWechatShopShelfData3
     */
    public function setImage($imageUrl) {
        $this->shelfData[self::IMG] = $imageUrl;
        return $this;
    }
}

class CHWechatShopShelfData4 extends CHWechatShopShelfBaseData {

    // 分组信息
    const GROUP_INFOS = 'group_infos';
    // 分组数组
    const GROUPS = 'groups';
    // 图片
    const IMG = 'img';
    // 分组ID
    const GROUP_ID = 'group_id';

    public function __construct($data=null)
    {
        parent::__construct($data);
        $this->eid = 4;
        if ($data == null) {
            $this->shelfData[self::GROUPS] = array();
        } else {
            if (isset($data[self::GROUP_INFOS])) {
                $this->shelfData = $data[self::GROUP_INFOS];
            }
        }
    }

    protected function getArray() {
        $dataArray = parent::getArray();
        $dataArray[self::GROUP_INFOS] = $this->shelfData;
        return $dataArray;
    }

    /**
     * 清除分组
     * @return CHWechatShopShelfData4
     */
    public function removeGroups() {
        $this->shelfData[self::GROUPS] = array();
        return $this;
    }

    /**
     * 添加分组
     * @param $groupId string
     * @param $imageUrl string
     * @return CHWechatShopShelfData4
     */
    public function addGroup($groupId, $imageUrl) {
        if (count($this->shelfData[self::GROUPS]) < 3) {
            $this->shelfData[self::GROUPS][] = array(self::GROUP_ID => $groupId, self::IMG => $imageUrl);
        }
        return $this;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: ChiHo
 * Date: 2017/4/6
 * Time: 14:30
 */

namespace CHWechatShop\Model;


use CHWechatShop\CHWechatShopConst;

class CHWechatShopExpressTemplate implements \JsonSerializable
{
    // 邮费模板id
    const TEMPLATE_ID = 'Id';
    // 邮费模板名称
    const NAME = 'Name';
    // 支付方式(0-买家承担运费, 1-卖家承担运费)
    const ASSUMER = 'Assumer';
    // 计费单位(0-按件计费, 1-按重量计费, 2-按体积计费，目前只支持按件计费，默认为0)
    const VALUATION = 'Valuation';

    // ========= 具体运费计算 ==========
    const TOP_FEE = 'TopFee';
    // 快递类型ID
    const TYPE = 'Type';

    // ========= 默认邮费计算方法 ==========
    const NORMAL = 'Normal';

    // ========= 指定地区邮费计算方法 ==========
    const CUSTOM = 'Custom';

    protected $templateId;
    protected $name;
    protected $assumer;
    protected $valuation;
    protected $topFeeData;

    public function __construct($data=null) {
        if ($data == null) {
            $this->topFeeData = array();
            $this->valuation = 0;
        } else {}
        if (isset($data[self::TEMPLATE_ID])) {
            $this->templateId = $data[self::TEMPLATE_ID];
        }
        if (isset($data[self::NAME])) {
            $this->name = $data[self::NAME];
        }
        if (isset($data[self::ASSUMER])) {
            $this->assumer = $data[self::ASSUMER];
        }
        if (isset($data[self::VALUATION])) {
            $this->valuation = $data[self::VALUATION];
        }
        if (isset($data[self::TOP_FEE])) {
            $feeAry = array();
            foreach ($data[self::TOP_FEE] as $feeData) {
                $feeAry[] = new CHWechatShopExpressFee($feeData);
            }
            $this->topFeeData = $feeAry;
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
        $dataArray[self::TOP_FEE] = $this->topFeeData;
        if (isset($this->templateId)) {
            $dataArray[self::TEMPLATE_ID] = $this->templateId;
        }
        if (isset($this->name)) {
            $dataArray[self::NAME] = $this->name;
        }
        if (isset($this->assumer)) {
            $dataArray[self::ASSUMER] = $this->assumer;
        }
        if (isset($this->valuation)) {
            $dataArray[self::VALUATION] = $this->valuation;
        }
        return $dataArray;
    }

    /**
     * 返回模版id
     * @return string
     */
    public function getTemplateId() {
        return $this->templateId;

    }

    /**
     * 获取模版名字
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * 设置模版名字
     * @param $name string
     * @return CHWechatShopExpressTemplate
     */
    public function setName($name) {
        if (empty($name)) {
            throw new \RuntimeException('Name invalid!');
        }
        $this->name = $name;
        return $this;
    }

    /**
     * 获取支付方式
     * @return int
     */
    public function getAssumer() {
        return $this->assumer;
    }

    /**
     * 设置支付方式
     * @param int $assumer
     * @return CHWechatShopExpressTemplate
     */
    public function setAssumer($assumer) {
        if ($assumer != CHWechatShopConst::ASSUMER_BUYER && $assumer != CHWechatShopConst::ASSUMER_SELLER) {
            throw new \RuntimeException('Assumer invalid!');
        }
        $this->assumer = $assumer;
        return $this;
    }

    /**
     * 清楚所有计费
     * @return CHWechatShopExpressTemplate
     */
    public function removeFees() {
        $this->topFeeData = array();
        return $this;
    }

    /**
     * 添加默认邮费
     * @param $deliveryType int
     * @param $normalFee CHWechatShopExpressFee
     * @param $customFees array
     * @return CHWechatShopExpressTemplate
     */
    public function addFee($deliveryType, CHWechatShopExpressFee $normalFee, $customFees) {
        if ($deliveryType != CHWechatShopConst::DELIVERY_TYPE_ID_EMS && $deliveryType != CHWechatShopConst::DELIVERY_TYPE_ID_EXPRESS && $deliveryType != CHWechatShopConst::DELIVERY_TYPE_ID_MAIL) {
            throw new \RuntimeException('Delivery type error!');
        }
        $this->topFeeData[] = array(self::TYPE => $deliveryType, self::NORMAL => $normalFee, self::CUSTOM => $customFees);
        return $this;
    }

    /**
     * 获取所有计费
     * @return array
     */
    public function getFees() {
        if (count($this->topFeeData)) {
            return $this->topFeeData;
    }
        return null;
    }
}

class CHWechatShopExpressFee implements \JsonSerializable
{
    protected $startStandards;
    protected $startFees;
    protected $addStandards;
    protected $addFees;
    protected $destCountry;
    protected $destProvince;
    protected $destCity;

    // 起始计费数量(比如计费单位是按件, 填2代表起始计费为2件)
    const START_STANDARDS = 'StartStandards';
    // 起始计费金额(单位: 分）
    const START_FEES = 'StartFees';
    // 递增计费数量
    const ADD_STANDARDS = 'AddStandards';
    // 递增计费金额(单位 : 分)
    const ADD_FEES = 'AddFees';
    // 指定国家
    const DEST_COUNTRY = 'DestCountry';
    // 指定省份
    const DEST_PROVINCE = 'DestProvince';
    // 指定城市
    const DEST_CITY = 'DestCity';

    public function __construct($data=null) {
        if ($data != null) {
            if (isset($data[self::START_STANDARDS])) {
                $this->startStandards = $data[self::START_STANDARDS];
            }
            if (isset($data[self::START_FEES])) {
                $this->startFees = $data[self::START_FEES];
            }
            if (isset($data[self::ADD_STANDARDS])) {
                $this->addStandards = $data[self::ADD_STANDARDS];
            }
            if (isset($data[self::ADD_FEES])) {
                $this->addFees = $data[self::ADD_FEES];
            }
            if (isset($data[self::DEST_COUNTRY])) {
                $this->destCountry = $data[self::DEST_COUNTRY];
            }
            if (isset($data[self::DEST_PROVINCE])) {
                $this->destProvince = $data[self::DEST_PROVINCE];
            }
            if (isset($data[self::DEST_CITY])) {
                $this->destCity = $data[self::DEST_CITY];
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

        if (isset($this->startStandards)) {
            $dataArray[self::START_STANDARDS] = $this->startStandards;
        }
        if (isset($this->startFees)) {
            $dataArray[self::START_FEES] = $this->startFees;
        }
        if (isset($this->addStandards)) {
            $dataArray[self::ADD_STANDARDS] = $this->addStandards;
        }
        if (isset($this->addFees)) {
            $dataArray[self::ADD_FEES] = $this->addFees;
        }
        if (isset($this->destCountry)) {
            $dataArray[self::DEST_COUNTRY] = $this->destCountry;
        }
        if (isset($this->destProvince)) {
            $dataArray[self::DEST_PROVINCE] = $this->destProvince;
        }
        if (isset($this->destCity)) {
            $dataArray[self::DEST_CITY] = $this->destCity;
        }
        return $dataArray;
    }

    /**
     * 设置费用
     * @param $startStandards int
     * @param $startFees int
     * @param $addStandards int
     * @param $addFees int
     * @return CHWechatShopExpressFee
     */
    public function setFee($startStandards, $startFees, $addStandards, $addFees) {
        if ($startStandards < 0 || $startFees < 0 || $addStandards < 0 || $addFees < 0) {
            throw new \RuntimeException('Fee invalid!');
        }
        $this->startStandards = $startStandards;
        $this->startFees = $startFees;
        $this->addStandards = $addStandards;
        $this->addFees = $addFees;
        return $this;
    }

    /**
     * 设置城市
     * @param $destCountry string
     * @param $destProvince string
     * @param $destCity string
     * @return CHWechatShopExpressFee
     */
    public function setCity($destCountry, $destProvince, $destCity) {
        if (empty($destCountry)) {
            throw new \RuntimeException('DestCountry invalid!');
        }
        if (empty($destProvince)) {
            throw new \RuntimeException('DestProvince invalid!');
        }
        if (empty($destCity)) {
            throw new \RuntimeException('DestCity invalid!');
        }
        $this->destCountry = $destCountry;
        $this->destProvince = $destProvince;
        $this->destCity = $destCity;
        return $this;
    }

    /**
     * 获取起始计费数量
     * @return int
     */
    public function getStartStandards() {
        return $this->startStandards;
    }

    /**
     * 获取起始计费金额
     * @return int
     */
    public function getStartFees() {
        return $this->startFees;
    }

    /**
     * 获取递增计费数量
     * @return int
     */
    public function getAddStandards() {
        return $this->addStandards;
    }

    /**
     * 获取递增计费金额
     * @return int
     */
    public function getAddFees() {
        return $this->addFees;
    }

    /**
     * 获取指定国家
     * @return string
     */
    public function getDestCountry() {
        return $this->destCountry;
    }

    /**
     * 获取指定省份
     * @return string
     */
    public function getDestProvince() {
        return $this->destProvince;
    }

    /**
     * 获取指定城市
     * @return string
     */
    public function getDestCity() {
        return $this->destCity;
    }
}
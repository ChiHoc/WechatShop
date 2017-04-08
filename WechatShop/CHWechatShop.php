<?php
namespace CHWechatShop;
use CHWechatShop\Model\CHWechatShopDelivery;
use CHWechatShop\Model\CHWechatShopExpressTemplate;
use CHWechatShop\Model\CHWechatShopGroup;
use CHWechatShop\Model\CHWechatShopProduct;
use CHWechatShop\Model\CHWechatShopShelf;

/**
 * Created by PhpStorm.
 * User: ChiHo
 * Date: 2017/4/1
 * Time: 10:37
 */
class CHWechatShop
{
    CONST DOMAIN = 'https://api.weixin.qq.com/merchant/';

    /**
     * 新增商品
     * @param  $product CHWechatShopProduct
     * @return array
     */
    public static function productCreate(CHWechatShopProduct $product) {
        $urlPath = 'create';
        return self::requestData($urlPath, $product);
    }

    /**
     * 删除商品
     * @param  $productId string
     * @return array
     */
    public static function productRemove($productId) {
        $urlPath = 'del';
        return self::requestData($urlPath, array('product_id' => $productId));
    }

    /**
     * 商品修改
     * @param $product CHWechatShopProduct
     * @return array
     */
    public static function productModify(CHWechatShopProduct $product) {
        $urlPath = 'update';
        return self::requestData($urlPath, $product);
    }

    /**
     * 商品查询
     * @param $productId string
     * @return array
     */
    public static function getProduct($productId) {
        $urlPath = 'get';
        return self::requestData($urlPath, array('product_id' => $productId));
    }

    /**
     * 获取指定状态的所有商品
     * @param $status int 0:下架，1:上架
     * @return array
     */
    public static function getProductByStatus($status) {
        $urlPath = 'getbystatus';
        return self::requestData($urlPath, array('status' => $status));
    }

    /**
     * 商品上下架/单个
     * @param product_id string 数组
     * @param $status int 0:下架，1:上架
     * @return array
     */
    public static function productStatus($productId, $status) {
        $urlPath = 'modproductstatus';
        return self::requestData($urlPath, array('product_id' => $productId, 'status' => $status));
    }

    /**
     * 获取指定分类的所有子分类
     * @param $categoryId int
     * @return array
     */
    public static function getCategories($categoryId = 1) {
        $urlPath = 'category/getsub';
        return self::requestData($urlPath, array('cate_id' => $categoryId));

    }

    /**
     * 获取指定子分类的所有SKU
     * @param $categoryId string
     * @return array
     */
    public static function getCategorySKU($categoryId) {
        $urlPath = 'category/getsku';
        return self::requestData($urlPath, array('cate_id' => $categoryId));
    }

    /**
     * 获取指定子分类的所有属性
     * @param $categoryId string
     * @return array
     */
    public static function getCategoryProperty($categoryId) {
        $urlPath = 'category/getproperty';
        return self::requestData($urlPath, array('cate_id' => $categoryId));
    }

    /**
     * 增加库存
     * @param $productId string
     * @param $quantity int
     * @param null $sku_info string
     * @return array
     */
    public static function addStock($productId, $quantity, $sku_info=null) {
        $urlPath = 'stock/add';
        return self::requestData($urlPath, array('product_id' => $productId, 'sku_info' => $sku_info ?: '', 'quantity' => $quantity));
    }

    /**
     * 减少库存
     * @param $productId string
     * @param $quantity int
     * @param null $sku_info string
     * @return array
     */
    public static function reduceStock($productId, $quantity, $sku_info=null)
    {
        $urlPath = 'stock/reduce';
        return self::requestData($urlPath, array('product_id' => $productId, 'sku_info' => $sku_info ?: '', 'quantity' => $quantity));
    }

    /**
     * 增加邮费模板
     * @param $template CHWechatShopExpressTemplate
     * @return array
     */
    public static function expressTemplateCreate(CHWechatShopExpressTemplate $template) {
        $urlPath = 'express/add';
        return self::requestData($urlPath, array('delivery_template' => $template));
    }

    /**
     * 删除邮费模板
     * @param $templateId string
     * @return array
     */
    public static function expressTemplateRemove($templateId) {
        $urlPath = 'express/del';
        return self::requestData($urlPath, array('template_id' => $templateId));
    }

    /**
     * 修改邮费模板
     * @param $templateId string
     * @param $templete CHWechatShopExpressTemplate
     * @return array
     */
    public static function expressTemplateModify($templateId, $templete) {
        $urlPath = 'express/update';
        return self::requestData($urlPath, array('template_id' => $templateId, 'delivery_template' => $templete));
    }

    /**
     * 获取邮费模板
     * @param $templateId string
     * @return array
     */
    public static function getExpressTemplate($templateId) {
        $urlPath = 'express/getbyid';
        return self::requestData($urlPath, array('template_id' => $templateId));
    }

    /**
     * 获取所有邮费模板
     * @return array
     */
    public static function getAllExpressTemplate() {
        $urlPath = 'express/getall';
        return self::requestData($urlPath);
    }

    /**
     * 增加分组
     * @param $group CHWechatShopGroup
     * @return array
     */
    public static function groupCreate($group) {
        $urlPath = 'group/add';
        return self::requestData($urlPath, array('group_detail' => $group));
    }

    /**
     * 删除分组
     * @param $groupId string
     * @return array
     */
    public static function groupRemove($groupId) {
        $urlPath = 'group/del';
        return self::requestData($urlPath, array('group_id' => $groupId));
    }

    /**
     * 修改分组名
     * @param $groupId string
     * @param $groupName string
     * @return array
     */
    public static function updateGroupName($groupId, $groupName) {
        $urlPath = 'group/propertymod';
        return self::requestData($urlPath, array('group_id' => $groupId, 'group_name' => $groupName));
    }

    /**
     * 修改分组商品
     * @param $groupId string
     * @param $groupModify array
     * @return array
     */
    public static function updateGroupProduct($groupId, $groupModify) {
        $urlPath = 'group/propertymod';
        return self::requestData($urlPath, array('group_id' => $groupId, 'product' => $groupModify));
    }

    /**
     * 获取所有分组
     * @return array
     */
    public static function getAllGroup() {
        $urlPath = 'group/getall';
        return self::requestData($urlPath);
    }

    /**
     * 获取指定分组
     * @param $groupId string
     * @return array
     */
    public static function getGroup($groupId) {
        $urlPath = 'group/getbyid';
        return self::requestData($urlPath, array('group_id' => $groupId));
    }

    /**
     * 增加货架
     * @param $shelf CHWechatShopShelf
     * @return array
     */
    public static function shelfCreate($shelf) {
        $urlPath = 'shelf/add';
        return self::requestData($urlPath, $shelf);
    }

    /**
     * 增加货架
     * @param $shelfId
     * @return array
     */
    public static function shelfRemove($shelfId) {
        $urlPath = 'shelf/del';
        return self::requestData($urlPath, array('shelf_id' => $shelfId));
    }

    /**
     * 修改货架
     * @param $shelf CHWechatShopShelf
     * @return array
     */
    public static function shelfModify($shelf) {
        $urlPath = 'shelf/mod';
        return self::requestData($urlPath, $shelf);
    }

    /**
     * 获取所有货架
     * @return array
     */
    public static function getAllShelf() {
        $urlPath = 'shelf/getall';
        return self::requestData($urlPath);
    }

    /**
     * 获取货架
     * @param $shelfId string
     * @return array
     */
    public static function getShelf($shelfId) {
        $urlPath = 'shelf/getbyid';
        return self::requestData($urlPath, array('shelf_id' => $shelfId));
    }


    /**
     * 获取订单详情
     * @param $orderId string
     * @return array
     */
    public static function getOrder($orderId) {
        $urlPath = 'order/getbyid';
        return self::requestData($urlPath, array('order_id' => $orderId));
    }

    /**
     * 根据订单状态/创建时间获取订单详情
     * @param $status int
     * @param $beginTime int
     * @param $endTime int
     * @return array
     */
    public static function getOrderByStatus($status=CHWechatShopConst::ORDER_STATUS_ALL, $beginTime=0, $endTime=null) {
        $urlPath = 'order/getbyfilter';
        $data = array();
        $data['begintime'] = $beginTime;
        if ($status != CHWechatShopConst::ORDER_STATUS_ALL) {
            $data['status'] = $status;
        }
        if ($endTime != null) {
            $data['endtime'] = $endTime;
        }
        return self::requestData($urlPath, $data);
    }

    /**
     * 设置订单发货信息
     * @param $delivery CHWechatShopDelivery
     * @return array
     */
    public static function setDelivery($delivery) {
        $urlPath = 'order/setdelivery';
        return self::requestData($urlPath, $delivery);
    }

    /**
     * 关闭订单
     * @param $orderId string
     * @return array
     */
    public static function orderClose($orderId) {
        $urlPath = 'order/close';
        return self::requestData($urlPath, array('order_id' => $orderId));
    }

    /**
     * 上传图片
     * @param $imagePath string 绝对路径
     * @param $imageName string 文件名+后缀
     * @return array
     */
    public static function uploadImage($imagePath, $imageName) {
        $urlPath = 'common/upload_img?filename=' . $imageName;
        return CHWechatShop::requestData($urlPath, file_get_contents(realpath($imagePath)));
    }

    /**
     * 请求数据
     * @param $urlPath string
     * @param $data object
     * @param $sendToken boolean
     * @return array
     */
    private static function requestData($urlPath, $data=null, $sendToken=true) {
        $postData = $data;
        $postUrl = CHWechatShop::DOMAIN . $urlPath;
        if ($data != null && !is_string($data)) {
            $postData = json_encode($data, JSON_UNESCAPED_UNICODE);
        }

        if ($sendToken) {
            if (strpos($postUrl, '?')) {
                $postUrl = $postUrl . '&access_token=' . CHWechatAccessToken::getToken();
            } else {
                $postUrl = $postUrl . '?access_token=' . CHWechatAccessToken::getToken();
            }
        }
        return self::post($postUrl, $postData);
    }

    /**
     * 发送请求
     * @param $url string
     * @param $data string
     * @return array
     */
    private static function post($url, $data) {
        $ch = curl_init();
        $header = array('Accept-Charset' => 'utf-8');
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        if ($data != null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, ($data));
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);
        $errorNo = curl_errno($ch);
        if ($errorNo) {
            return array('errcode' => $errorNo, 'errmsg' => curl_error($ch));
        } else {
            $result = json_decode($tmpInfo, true);
            return CHWechatShop::parseResult($result);
        }
    }

    /**
     * 解析结果
     * @param $result array
     * @return array
     */
    private static function parseResult(array $result) {
        if (isset($result['errcode']) && $result['errcode'] != 0 && isset(CHWechatAccessToken::$ERROR_CODE[$result['errcode']])) {
            $result['errmsg'] = CHWechatAccessToken::$ERROR_CODE[$result['errcode']];
        }
        return $result;
    }
}
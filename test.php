<?php

use CHWechatShop\Model\CHWechatShopDelivery;
use CHWechatShop\Model\CHWechatShopExpressFee;
use CHWechatShop\Model\CHWechatShopExpressTemplate;
use CHWechatShop\Model\CHWechatShopGroup;
use CHWechatShop\Model\CHWechatShopGroupModify;
use CHWechatShop\Model\CHWechatShopProduct;
use CHWechatShop\Model\CHWechatShopShelf;
use CHWechatShop\Model\CHWechatShopShelfData1;
use CHWechatShop\Model\CHWechatShopShelfData2;
use CHWechatShop\Model\CHWechatShopShelfData3;
use CHWechatShop\Model\CHWechatShopShelfData4;
use CHWechatShop\CHWechatShop;
use CHWechatShop\CHWechatShopConst;

class UnitTest {

    public static function register() {
        spl_autoload_register("UnitTest::loadClass");
    }

    public static function loadClass($class) {
        $class = str_replace('\\', '/', $class);
        $class = "./".$class.".php";
        require_once $class;
    }

    public static function test(){

        self::register();

        $result = array();

        // 上传图片
        $result['uploadImage'] = array('params' => array('imagePath' => "image.png"),
            'result' => CHWechatShop::uploadImage("image.png", "image.png"));
        $image = $result['uploadImage']['result']['image_url'];

        // 创建商品
        $product = new CHWechatShopProduct();
        $product->setName('测试商品')
            ->setCategoryId('537074298')
            ->setMainImage($image)
            ->addImage($image)
            ->addDetailText('添加描述')
            ->addDetailText(date('Y-m-d h:m:s'))
            ->setPostFree(CHWechatShopConst::NOT_POST_FREE)
            ->addCustomExpress(CHWechatShopConst::DELIVERY_TYPE_ID_EMS, 200)
            ->addSku(null, 2000, $image, 30);
        $result['productCreate'] = array('params' => array('product' => $product),
            'result' => CHWechatShop::productCreate($product));

//        // 获取分类
//        $result['getCategories'] = array('params' => array('categoryId' => 538115192),
//            'result' => CHWechatShop::getCategories(538115192));
//
//        // 获取分类SKU
//        $result['getCategorySKU'] = array('params' => array('categoryId' => 537115215),
//            'result' => CHWechatShop::getCategorySKU(537115215));
//
//        // 获取分类属性
//        $result['getProductByStatus'] = array('params' => array('categoryId' => 537115215),
//            'result' => CHWechatShop::getCategoryProperty(537115215));
//
//        if ($result['productCreate']['result']['errcode'] == 0) {
//            $productId = $result['productCreate']['result']['product_id'];
//            // 删除商品
//            $result['productRemove'] = array('params' => array('productId' => $productId),
//                'result' => CHWechatShop::productRemove($productId));
//        }
//
//        // 增加货架
//        $shelf = (new CHWechatShopShelf())->setShelfBanner($image)->setShelfName("测试货架");
//        $shelf->addShelfData((new CHWechatShopShelfData1())->setProductCount(4)->setGroupId('416310720'))
//            ->addShelfData((new CHWechatShopShelfData2())->addGroup('416488071')->addGroup('416488061')->addGroup('416310720'))
//            ->addShelfData((new CHWechatShopShelfData3())->setGroupId('416488071')->setImage($image))
//            ->addShelfData((new CHWechatShopShelfData4())->addGroup('416310720', $image)->addGroup('416488071', $image)->addGroup('416488061', $image));
//
//        // 获取指定状态的所有商品
//        $result['getProductByStatus'] = array('params' => array('status' => CHWechatShopConst::PRODUCT_SHELVE),
//            'result' => CHWechatShop::getProductByStatus(CHWechatShopConst::PRODUCT_SHELVE));
//
//        // 获取指定状态的所有商品
//        $result['getProduct'] = array('params' => array('productId' => 'pXy6ujkx01pfqTaThrSDLd9G0PJ4'),
//            'result' => CHWechatShop::getProduct('pXy6ujkx01pfqTaThrSDLd9G0PJ4'));
//
//        if ($result['getProduct']['result']['errcode'] == 0) {
//            $product = new CHWechatShopProduct($result['getProduct']['result']['product_info']);
//            $product->removeDetail()->addDetailText('添加描述')->addDetailText(date('Y-m-d h:m:s'));
//            // 修改商品
//            $result['productModify'] = array('params' => array('product' => $product),
//                'result' => CHWechatShop::productModify($product));
//        }
//
//        // 上架
//        $result['shelve'] = array('params' => array('productId' => 'pXy6ujkx01pfqTaThrSDLd9G0PJ4', 'status' => CHWechatShopConst::PRODUCT_SHELVE),
//            'result' => CHWechatShop::productStatus('pXy6ujkx01pfqTaThrSDLd9G0PJ4', CHWechatShopConst::PRODUCT_SHELVE));
//
//        // 增加库存
//        $result['addStock'] = array('params' => array('productId' => 'pXy6ujkx01pfqTaThrSDLd9G0PJ4', '$quantity' => 1),
//            'result' => CHWechatShop::addStock('pXy6ujkx01pfqTaThrSDLd9G0PJ4', 1));
//
//        // 减少库存
//        $result['reduceStock'] = array('params' => array('productId' => 'pXy6ujkx01pfqTaThrSDLd9G0PJ4', '$quantity' => 1),
//            'result' => CHWechatShop::reduceStock('pXy6ujkx01pfqTaThrSDLd9G0PJ4', 1));
//
//        // 增加邮费模板
//        $templete = new CHWechatShopExpressTemplate();
//        $normalFee = new CHWechatShopExpressFee();
//        $customFee = new CHWechatShopExpressFee();
//        $normalFee->setFee(1, 100, 1, 200);
//        $customFee->setFee(1, 100, 1, 200)->setCity('中国', '广东省', '广州市');
//        $templete->setName('新建测试模版')->setAssumer(CHWechatShopConst::BUYER_PAY_DELIVERY_FEE)->addFee(CHWechatShopConst::DELIVERY_TYPE_ID_EXPRESS, $normalFee, array($customFee));
//        $result['expressTemplateCreate'] = array('params' => array('templete' => $templete),
//            'result' => CHWechatShop::expressTemplateCreate($templete));
//
//        if ($result['expressTemplateCreate']['result']['errcode'] == 0) {
//            $templeteId = $result['expressTemplateCreate']['result']['template_id'];
//
//            // 获取指定ID的邮费模板
//            $result['getExpressTemplate'] = array('params' => array('templateId' => $templeteId),
//                'result' => CHWechatShop::getExpressTemplate($templeteId));
//
//            $templete = new CHWechatShopExpressTemplate($result['getExpressTemplate']['result']['template_info']);
//            $normalFee = new CHWechatShopExpressFee();
//            $customFee = new CHWechatShopExpressFee();
//            $normalFee->setFee(2, 1000, 2, 2000);
//            $customFee->setFee(2, 1000, 2, 2000)->setCity('中国', '山西省', '太原市');
//            $templete->setName('修改测试模版')->removeFees()->setAssumer(CHWechatShopConst::BUYER_PAY_DELIVERY_FEE)->addFee(CHWechatShopConst::DELIVERY_TYPE_ID_EXPRESS, $normalFee, array($customFee));
//            // 修改邮费模板
//            $result['expressTemplateModify'] = array('params' => array('templateId' => $templeteId, 'template' => $templete),
//                'result' => CHWechatShop::expressTemplateModify($templeteId, $templete));
//
//            // 删除邮费模板
//            $result['expressTemplateRemove'] = array('params' => array('templateId' => $templeteId),
//                'result' => CHWechatShop::expressTemplateRemove($templeteId));
//        }
//
//        // 增加分组
//        $group = new CHWechatShopGroup();
//        $group->setGroupName('测试分组')->addProduct('pXy6ujkx01pfqTaThrSDLd9G0PJ4');
//        $result['groupCreate'] = array('params' => array('group' => $group),
//            'result' => CHWechatShop::groupCreate($group));
//
//        if ($result['groupCreate']['result']['errcode'] == 0) {
//            $groupId = $result['groupCreate']['result']['group_id'];
//
//            sleep(1);
//
//            // 获取分组
//            $result['getGroup'] = array('params' => array('groupId' => $groupId),
//                'result' => CHWechatShop::getGroup($groupId));
//
//            // 编辑分组名
//            $result['updateGroupName'] = array('params' => array('groupId' => $groupId, 'groupName' => '修改分组名'),
//                'result' => CHWechatShop::updateGroupName($groupId, '修改分组名'));
//
//            $modify = new CHWechatShopGroupModify('pXy6ujkx01pfqTaThrSDLd9G0PJ4', CHWechatShopConst::GROUP_PRODUCT_ADD);
//            // 修改分组商品
//            $result['updateGroupProduct'] = array('params' => array('groupId' => $groupId, 'groupName' => '修改分组名'),
//                'result' => CHWechatShop::updateGroupProduct($groupId, array($modify)));
//
//            // 编辑分组名
//            $result['updateGroupName'] = array('params' => array('groupId' => $groupId, 'groupName' => '修改分组名'),
//                'result' => CHWechatShop::updateGroupName($groupId, '修改分组名'));
//
//            // 删除分组
//            $result['groupRemove'] = array('params' => array('groupId' => $groupId),
//                'result' => CHWechatShop::groupRemove($groupId));
//        }
//
//        // 获取所有分组
//        $result['getAllGroup'] = array('params' => null,
//            'result' => CHWechatShop::getAllGroup());
//
//        $delivery = new CHWechatShopDelivery();
//        $delivery->setOrderId('10281205985306658720')->setDeliveryTrackNo('111122223333')->setDeliveryCompany(CHWechatShopConst::EXPRESS_ID_SHUNFENG);
//        // 设置订单发货信息
//        $result['setDelivery'] = array('params' => array('delivery' => $delivery),
//            'result' => CHWechatShop::setDelivery($delivery));
//
//        // 关闭订单
//        $result['orderClose'] = array('params' => array('orderId' => '10281205985306658720'),
//            'result' => CHWechatShop::orderClose('10281205985306658720'));
//
//        // 获取订单
//        $result['getOrder'] = array('params' => array('orderId' => '10281205985306658720'),
//            'result' => CHWechatShop::getOrder('10281205985306658720'));
//
//        // 根据订单状态/创建时间获取订单详情
//        $result['getOrderByStatus'] = array('params' => array('status' => CHWechatShopConst::ORDER_STATUS_ALL),
//            'result' => CHWechatShop::getOrderByStatus());
//
//        // 获取所有货架
//        $result['getAllShelf'] = array('params' => null,
//            'result' => CHWechatShop::getAllShelf());
//
//
//        $result['shelfCreate'] = array('params' => array('shelf' => $shelf),
//            'result' => CHWechatShop::shelfCreate($shelf));
//
//        if ($result['shelfCreate']['result']['errcode'] == 0) {
//            $shelfId = $result['shelfCreate']['result']['shelf_id'];
//
//            sleep(1);
//
//            // 获取货架
//            $result['getShelf'] = array('params' => array('shelfId' => $shelfId),
//                'result' => CHWechatShop::getShelf($shelfId));
//
//            if ($result['getShelf']['result']['errcode'] == 0) {
//                $shelf = new CHWechatShopShelf($result['getShelf']['result']);
//                $shelf->removeShelfData()->addShelfData((new CHWechatShopShelfData1())->setProductCount(4)->setGroupId('416310720'))
//                    ->addShelfData((new CHWechatShopShelfData2())->addGroup('416488071')->addGroup('416488061')->addGroup('416310720'))
//                    ->addShelfData((new CHWechatShopShelfData3())->setGroupId('416488071')->setImage($image))
//                    ->addShelfData((new CHWechatShopShelfData4())->addGroup('416310720', $image)->addGroup('416488071', $image)->addGroup('416488061', $image));
//
//                // 修改货架
//                $result['shelfModify'] = array('params' => array('shelf' => $shelf),
//                    'result' => CHWechatShop::shelfModify($shelf));
//            }
//
//            // 删除货架
//            $result['shelfRemove'] = array('params' => array('shelfId' => $shelfId),
//                'result' => CHWechatShop::shelfRemove($shelfId));
//        }

        return $result;
    }
}

echo json_encode(UnitTest::test(), JSON_UNESCAPED_UNICODE);

?>
# WechatShop  
微信小店接口PHP封装  
  
# Usage  
## 获取分类  
  
CHWechatShop::getCategories('cat_id')  
  
## 获取分类SKU  
CHWechatShop::getCategorySKU('cat_id')  
  
## 获取分类属性  
CHWechatShop::getCategoryProperty('cat_id')  
  
## 获取指定状态的所有商品  
CHWechatShop::getProductByStatus(CHWechatShopConst::PRODUCT_SHELVE)  
  
## 下架  
CHWechatShop::productStatus('product_id', CHWechatShopConst::PRODUCT_UNSHELVE)  
  
## 获取指定状态的所有商品  
CHWechatShop::getProduct('product_id')  
  
## 创建商品  
$product = new CHWechatShopProduct()  

$product->setName('name')->setCategoryId('cat_id')->setMainImage('image')->addImage('image')->addDetailText('text'))  

CHWechatShop::productCreate($product)  
  
## 修改商品  
CHWechatShop::productModify($product)  
  
## 上架  
CHWechatShop::productStatus('product_id', CHWechatShopConst::PRODUCT_SHELVE)  
  
## 增加库存  
CHWechatShop::addStock('product_id', 1)  
  
## 减少库存  
CHWechatShop::reduceStock('product_id', 1)  
  
## 增加邮费模板  
$templete = new CHWechatShopExpressTemplate()  

$normalFee = new CHWechatShopExpressFee()  

$customFee = new CHWechatShopExpressFee()  

$normalFee->setFee(1, 100, 1, 200)  

$customFee->setFee(2, 200, 2, 400)->setCity('中国', '广东省', '广州市')  

$templete->setName('name')->setAssumer(CHWechatShopConst::BUYER_PAY_DELIVERY_FEE)->addFee(CHWechatShopConst::DELIVERY_TYPE_ID_EXPRESS, $normalFee, array($customFee))  

CHWechatShop::expressTemplateCreate($templete)  
  
## 修改邮费模板  
CHWechatShop::expressTemplateModify('templete_id', $templete)  
  
## 获取指定ID的邮费模板  
CHWechatShop::getExpressTemplate('templete_id')  
  
## 删除邮费模板  
CHWechatShop::expressTemplateRemove('templete_id')  
  
## 增加分组  
$group = new CHWechatShopGroup()  

$group->setGroupName('name')->addProduct('product_id')  

CHWechatShop::groupCreate($group)  
  
## 编辑分组名  
CHWechatShop::updateGroupName('group_id', 'name')  
  
## 修改分组商品  
$modify = new CHWechatShopGroupModify('product_id', CHWechatShopConst::GROUP_PRODUCT_ADD)  

CHWechatShop::updateGroupProduct('group_id', array($modify))  
  
## 获取分组  
CHWechatShop::getGroup('group_id')  
  
## 删除分组  
CHWechatShop::groupRemove('group_id')  
  
## 获取所有分组  
CHWechatShop::getAllGroup()  
  
## 设置订单发货信息  
$delivery = new CHWechatShopDelivery()  

$delivery->setOrderId('order_id')->setDeliveryTrackNo('track_no')->setDeliveryCompany(CHWechatShopConst::EXPRESS_ID_SHUNFENG)  

CHWechatShop::setDelivery($delivery)  
  
## 关闭订单  
CHWechatShop::orderClose('order_id')  
  
## 获取订单  
CHWechatShop::getOrder('order_id')  
  
## 根据订单状态/创建时间获取订单详情  
CHWechatShop::getOrderByStatus()  
  
## 上传图片  
CHWechatShop::uploadImage('path', "name")  
  
## 删除商品  
CHWechatShop::productRemove('product_id')  
  
## 增加货架  
$shelf = (new CHWechatShopShelf())->setShelfBanner('imageUrl')->setShelfName('name')  

$shelf->addShelfData((new CHWechatShopShelfData1())->setProductCount(1)->setGroupId('group_id'))  

CHWechatShop::shelfCreate($shelf)  
  
## 获取货架  
CHWechatShop::getShelf('shelf_id')  
  
## 修改货架  
CHWechatShop::shelfModify($shelf)  
  
## 删除货架  
CHWechatShop::shelfRemove('shelf_id')  
  
## 获取所有货架  
CHWechatShop::getAllShelf()  

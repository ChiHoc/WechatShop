# 微信小店接口PHP封装

**WechatShop**

微信小店api文档地址：[https://mp.weixin.qq.com/wiki/8/703923b7349a607f13fb3100163837f0.html](https://mp.weixin.qq.com/wiki/8/703923b7349a607f13fb3100163837f0.html)

## 目录
* [商品管理接口](#商品管理接口)
    * [增加商品](#增加商品)
    * [删除商品](#删除商品)
    * [修改商品](#修改商品)
    * [查询商品](#查询商品)
    * [获取指定状态的所有商品](#获取指定状态的所有商品)
    * [商品上下架](#商品上下架)
    * [获取指定分类的所有子分类](#获取指定分类的所有子分类)
    * [获取指定分类的所有SKU](#获取指定分类的库存信息)
    * [获取指定分类的所有属性](#获取指定分类的所有属性)
* [库存管理接口](#库存管理接口)
    * [增加库存](#增加库存)
    * [减少库存](#减少库存)
* [邮费模板管理接口](#邮费模板管理接口)
    * [增加邮费模板](#增加邮费模板)
    * [删除邮费模板](#删除邮费模板)
    * [修改邮费模板](#修改邮费模板)
    * [获取指定ID的邮费模板](#获取邮费模板)
    * [获取所有邮费模板](#获取所有邮费模板)
* [分组管理接口](#分组管理接口)
    * [增加分组](#增加分组)
    * [删除分组](#删除分组)
    * [修改分组属性](#修改分组属性)
    * [修改分组商品](#修改分组商品)
    * [获取所有分组](#获取所有分组)
    * [根据分组ID获取分组信息](#获取分组信息)
* [货架管理接口](#货架管理接口)
    * [增加货架](#增加货架)
    * [删除货架](#删除货架)
    * [修改货架](#修改货架)
    * [获取所有货架](#获取所有货架)
    * [根据货架ID获取货架信息](#获取货架信息)
* [订单管理接口](#订单管理接口)
    * [根据订单ID获取订单详情](#获取订单详情)
    * [根据订单状态/创建时间获取订单详情](#根据条件获取订单详情)
    * [设置订单发货信息](#设置订单发货信息)
    * [关闭订单](#关闭订单)
* [功能接口](#功能接口)
    * [上传图片](#上传图片)

## 商品管理接口

### 增加商品

```php
$product = new CHWechatShopProduct();
$product->setName('name')->setCategoryId('cat_id')->setMainImage('imageUrl')->addImage('imageUrl')->addDetailText('text'));
CHWechatShop::productCreate($product);
```

### 删除商品

```php
CHWechatShop::productRemove('product_id');
```

### 修改商品

```php
$product = new CHWechatShopProduct();
$product->setName('name')->setCategoryId('cat_id')->setMainImage('imageUrl')->addImage('imageUrl')->addDetailText('text'));
CHWechatShop::productModify($product);
```

### 查询商品

```php
CHWechatShop::getProductByStatus(CHWechatShopConst::PRODUCT_SHELVE);
```

### 获取指定状态的所有商品

```php
CHWechatShop::getProduct('product_id');
```

### 商品上下架

```php
CHWechatShop::productStatus('product_id', CHWechatShopConst::PRODUCT_SHELVE);
```

### 获取指定分类的所有子分类

```php
CHWechatShop::getCategories('cat_id');
```

### 获取指定分类的库存信息

```php
CHWechatShop::getCategorySKU('cat_id');
```

### 获取指定分类的所有属性

```php
CHWechatShop::getCategoryProperty('cat_id');
```

## 库存管理接口

### 增加库存

```php
CHWechatShop::addStock('product_id', 1);
```

### 减少库存

```php
CHWechatShop::reduceStock('product_id', 1);
```

## 邮费模板管理接口

### 增加邮费模板

```php
$templete = new CHWechatShopExpressTemplate();
$normalFee = new CHWechatShopExpressFee();
$customFee = new CHWechatShopExpressFee();
$normalFee->setFee(1, 100, 1, 200);
$customFee->setFee(2, 200, 2, 400)->setCity('中国', '广东省', '广州市');
$templete->setName('name')->setAssumer(CHWechatShopConst::BUYER_PAY_DELIVERY_FEE)->addFee(CHWechatShopConst::DELIVERY_TYPE_ID_EXPRESS, $normalFee, array($customFee));
CHWechatShop::expressTemplateCreate($templete);
```

### 修改邮费模板

```php
$templete = new CHWechatShopExpressTemplate();
$normalFee = new CHWechatShopExpressFee();
$customFee = new CHWechatShopExpressFee();
$normalFee->setFee(1, 100, 1, 200);
$customFee->setFee(2, 200, 2, 400)->setCity('中国', '广东省', '广州市');
$templete->setName('name')->setAssumer(CHWechatShopConst::BUYER_PAY_DELIVERY_FEE)->addFee(CHWechatShopConst::DELIVERY_TYPE_ID_EXPRESS, $normalFee, array($customFee));
CHWechatShop::expressTemplateModify('templete_id', $templete);
```

### 获取邮费模板

```php
CHWechatShop::getExpressTemplate('templete_id');
```

### 获取所有邮费模板

```php
CHWechatShop::getAllExpressTemplate();
```

### 删除邮费模板

```php
CHWechatShop::expressTemplateRemove('templete_id');
```

## 分组管理接口

### 增加分组

```php
$group = new CHWechatShopGroup();
$group->setGroupName('name')->addProduct('product_id');
CHWechatShop::groupCreate($group);
```

### 删除分组

```php
CHWechatShop::groupRemove('group_id');
```

### 修改分组属性

```php
CHWechatShop::updateGroupName('group_id', 'name');
```

### 修改分组商品

```php
$modify = new CHWechatShopGroupModify('product_id', CHWechatShopConst::GROUP_PRODUCT_ADD);
CHWechatShop::updateGroupProduct('group_id', array($modify));
```

### 获取所有分组

```php
CHWechatShop::getAllGroup();
```

### 获取分组信息

```php
CHWechatShop::getGroup('group_id');
```

## 货架管理接口

### 增加货架

```php
$shelf = (new CHWechatShopShelf())->setShelfBanner('imageUrl')->setShelfName('name');
$shelf->addShelfData((new CHWechatShopShelfData1())->setProductCount(1)->setGroupId('group_id'));
CHWechatShop::shelfCreate($shelf);
```

### 删除货架

```php
CHWechatShop::shelfRemove('shelf_id');
```

### 修改货架

```php
$shelf = (new CHWechatShopShelf())->setShelfBanner('imageUrl')->setShelfName('name');
$shelf->addShelfData((new CHWechatShopShelfData1())->setProductCount(1)->setGroupId('group_id'));
CHWechatShop::shelfModify($shelf);
```

### 获取所有货架

```php
CHWechatShop::getAllShelf();
```

### 获取货架信息

```php
CHWechatShop::getShelf('shelf_id');
```

## 订单管理接口

### 获取订单详情

```php
CHWechatShop::getOrder('order_id');
```

### 根据条件获取订单详情

```php
CHWechatShop::getOrderByStatus(CHWechatShopConst::ORDER_STATUS_TO_SEND, 0, 1491795684);
```

### 设置订单发货信息

```php
$delivery = new CHWechatShopDelivery();
$delivery->setOrderId('order_id')->setDeliveryTrackNo('track_no')->setDeliveryCompany(CHWechatShopConst::EXPRESS_ID_SHUNFENG);
CHWechatShop::setDelivery($delivery);
```

### 关闭订单

```php
CHWechatShop::orderClose('order_id');
```

## 功能接口

### 上传图片

```php
CHWechatShop::uploadImage('filePath', "imageName");
```
## Install

Via Composer

```php
{
    "require": {
        "chiho/wechatshop": "1.0.0"
    }
}
```

## License

The MIT License (MIT). Please see [License File](https://github.com/ChiHoc/WechatShop/blob/master/LICENSE) for more information.

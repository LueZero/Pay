## 整合第三方金流服務

- [綠界科技](https://www.ecpay.com.tw/)
- [Line金流](https://pay.line.me/portal/tw/main)

## 付款使用方式

```php
require './vendor/autoload.php';

use Zero\Pay\Pay as Pay;

// 綠界 付款範例
$payment = Pay::setPay("ecPay");

$requestsData = [
  "MerchantID" => 2000132,
  "MerchantTradeNo" => "zero" . date("YmdHis"),
  "MerchantTradeDate" => date("Y/m/d H:i:s"),
  "PaymentType" => "aio",
  "TotalAmount" => 500,
  "TradeDesc" => urlencode("測試交易"),
  "ItemName" => "手機20元",
  "ReturnURL" => "https://your.web.site/receive.php",
  "ChoosePayment" => "Credit",
  "EncryptType" => 1,
];
$payment->requestParameter($requestsData);
$payment->dataProcess();
echo $payment->checkouts();

// 綠界 搜尋範例
$requestsData = [
  "MerchantID" => 2000132,
  "MerchantTradeNo" => "xxxxx",
  "TimeStamp" => time(),
  "PlatformID" => 2000132,
];
$payment->requestParameter($requestsData);
$payment->dataProcess();
echo $payment->search();

// 綠界 退款範例
$requestsData = [
    "MerchantID" => 2000132,
    "MerchantTradeNo" => "xxx",
    "TradeNo" => "xxx",
    "Action" => "R",
    "TotalAmount" => 100,
];
$payment->requestParameter($requestsData);
$payment->dataProcess();
echo $payment->refund();
```

```php
require './vendor/autoload.php';

use Zero\Pay\Pay as Pay;

// LinePay 付款範例
$payment = Pay::setPay("linePay");
$requestsData = [
  'amount' => 100,
  'currency' => 'TWD',
  'orderId' => "zero" . date("YmdHis"),
  'packages' => [
    [
      "id" => 1,
      'amount' => 100,
      'name' => "Test",
      'products' => [
        [
          'name' => "測試商品",
          "imageUrl" => "https://img.ruten.com.tw/s1/8/5f/69/21309199705961_969_m.jpg",
          'quantity' => 1,
          'price' => 100,
        ]
      ],
    ]
  ],
  'redirectUrls' => [
    'confirmUrl' => "https://your.web.site/receive.php",
    'cancelUrl' => "https://your.web.site/receive.php"
  ]
];
$payment->requestParameter($requestsData);
$payment->dataProcess();
echo $payment->checkouts();

// linePay 確認範例
$orderId = 2020121500644803510;
$requestsData = [
  "amount" => 100,
  "currency" => "TWD",
];
$payment->requestParameter($requestsData);
$payment->dataProcess();
echo $payment->confirm($orderId);

// LinePay 查詢範例
$requestsData = [
  "orderId" => 20121414550564000006
];
$payment->requestParameter($requestsData);
$payment->dataProcess();
echo $payment->search();

// LinePay 退款範例
$orderId = 2020121500644803510;
$requestsData = [
  "refundAmount" => 100
];
$payment->requestParameter($requestsData);
$payment->dataProcess();
echo $payment->refund($orderId);
```

## 測試使用指令
```zsh
./vendor/bin/phpunit tests
```
<?php

namespace Zero\Pay;

use Zero\Pay\PayMethod\EcPay;
use Zero\Pay\PayMethod\LinePay;
use Zero\Pay\PaySend\EcPaySend;
use Zero\Pay\PaySend\LinePaySend;

class Pay
{
    public static $pay;

    /**
     * 設定支付
     */
    public static function setPay($className)
    {
        $name = strtolower($className);
        if ($name == "ecpay") {
            self::$pay = new EcPay($name, new EcPaySend());
        } else if ($name == "linepay") {
            self::$pay = new LinePay($name, new LinePaySend());
        } else {
            throw new \Exception('no pay method class');
        }
        return self::$pay;
    }

    /**
     * 請求參數
     */
    public function requestParameter($data)
    {
        self::$pay->requestParameter($data);
        return $this;
    }

    /**
     * 金流資料處理
     */
    public function dataProcess()
    {
        self::$pay->dataProcess();
        return $this;
    }

    /**
     * 結帳
     */
    public function checkouts()
    {
        return self::$pay->checkouts();
    }

    /**
     * 搜尋
     */
    public function search()
    {
        return self::$pay->search();
    }

    /**
     * 退款
     */
    public function refund($orderId = null)
    {
        return self::$pay->refund($orderId);
    }

    // 保留
    // public static function __callStatic($value, $args)
    // {
    //     return static::$locale::$$value;
    // }
}

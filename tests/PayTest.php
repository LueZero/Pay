<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Zero\Pay\Pay as Pay;

final class PayTest extends TestCase
{
    /**
     * @test
     */
    public function Given_EcPay_When_SetPay_Then_Retur_EcPay(): void
    {
        $pay = Pay::setPay("ecPay");
        $this->assertStringStartsWith('Zero\Pay\PayMethod\EcPay', get_class($pay));
    }

    /**
     * @test
     */
    public function Given_LinePay_When_SetPay_Then_Retur_LinePay(): void
    {
        $pay = Pay::setPay("LinePay");
        $this->assertStringStartsWith('Zero\Pay\PayMethod\LinePay', get_class($pay));
    }

    /**
     * @test
     */
    public function Given_ZeroPay_When_SetPay_Then_Throw_Exception()
    {
        $this->expectException(Exception::class);
        $pay = Pay::setPay("ZeroPay");
    }
}

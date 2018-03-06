<?php

namespace webignition\Tests\Model\Stripe;

use webignition\Model\Stripe\Coupon;

class CouponTest extends AbstractBaseTest
{
    public function testGetCouponProperties()
    {
        $coupon = new Coupon($this->loadFixture('/Coupon/coupon.json'));

        $this->assertEquals('TMS', $coupon->getId());
        $this->assertEquals(20, $coupon->getPercentOff());
    }
}

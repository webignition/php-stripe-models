<?php

namespace webignition\Tests\Model\Stripe;

use webignition\Model\Stripe\Coupon;
use webignition\Model\Stripe\Discount;
use webignition\Model\Stripe\Period;

class DiscountTest extends AbstractBaseTest
{
    public function testGetDiscountProperties()
    {
        $discount = new Discount($this->loadFixture('/Discount/discount.json'));

        $this->assertEquals('cus_4ZpdOIgXTGsiax', $discount->getCustomerId());

        $period = $discount->getPeriod();
        $this->assertInstanceOf(Period::class, $period);
        $this->assertEquals(1407852586, $period->getStart());
        $this->assertEquals(null, $period->getEnd());

        $coupon = $discount->getCoupon();
        $this->assertInstanceOf(Coupon::class, $coupon);
        $this->assertEquals('TMS', $coupon->getId());
    }
}

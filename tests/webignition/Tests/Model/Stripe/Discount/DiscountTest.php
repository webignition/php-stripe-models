<?php

namespace webignition\Tests\Model\Stripe\Discount;

use webignition\Tests\Model\Stripe\ObjectTest;

class DiscountTest extends ObjectTest {

    public function testGetPeriod() {
        $this->assertInstanceOf('webignition\Model\Stripe\Period', $this->getDiscount()->getPeriod());
    }


    public function testGetCustomerId() {
        $this->assertEquals('cus_4ZpdOIgXTGsiax', $this->getDiscount()->getCustomerId());
    }


    public function testGetCoupon() {
        $this->assertInstanceOf('webignition\Model\Stripe\Coupon', $this->getDiscount()->getCoupon());
    }
    
    
    /**
     * 
     * @return \webignition\Model\Stripe\Discount
     */
    private function getDiscount() {
        return $this->object;
    }
    
}
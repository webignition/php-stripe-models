<?php

namespace webignition\Tests\Model\Stripe\Coupon;

use webignition\Tests\Model\Stripe\ObjectTest;

class CouponTest extends ObjectTest {
    
    public function testGetId() {
        $this->assertEquals('TMS', $this->getCoupon()->getId());
    }

    public function testGetPercentOff() {
        $this->assertEquals(20, $this->getCoupon()->getPercentOff());
    }
    
    
    /**
     * 
     * @return \webignition\Model\Stripe\Coupon
     */
    private function getCoupon() {
        return $this->object;
    }
    
}
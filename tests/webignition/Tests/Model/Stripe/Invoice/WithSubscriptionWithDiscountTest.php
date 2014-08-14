<?php

namespace webignition\Tests\Model\Stripe\Invoice;

use webignition\Tests\Model\Stripe\ObjectTest;

class WithSubscriptionWithDiscountTest extends ObjectTest {

    public function testHasDiscount() {
        $this->assertTrue($this->getInvoice()->hasDiscount());
    }

    public function testGetDiscount() {
        $this->assertInstanceOf('webignition\Model\Stripe\Discount', $this->getInvoice()->getDiscount());
    }
    
    /**
     * 
     * @return \webignition\Model\Stripe\Invoice\Invoice
     */
    private function getInvoice() {
        return $this->object;
    }
    
}
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

    public function testGetSubtotal() {
        $this->assertEquals(900, $this->getInvoice()->getSubtotal());
    }

    public function testGetTotal() {
        $this->assertEquals(720, $this->getInvoice()->getTotal());
    }

    /**
     * 
     * @return \webignition\Model\Stripe\Invoice\Invoice
     */
    private function getInvoice() {
        return $this->object;
    }
    
}
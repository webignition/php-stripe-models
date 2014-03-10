<?php

namespace webignition\Tests\Model\Stripe\LineItem;

use webignition\Tests\Model\Stripe\ObjectTest;

class InvoiceItemTest extends ObjectTest { 
    
    public function testGetId() {
        $this->assertEquals('ii_3ceeSvsBe2qaNA', $this->getInvoiceItem()->getId());
    }   
    
    public function testGetAmount() {
        $this->assertEquals(1000, $this->getInvoiceItem()->getAmount());
    }  
    
    public function testGetCurrency() {
        $this->assertEquals('gbp', $this->getInvoiceItem()->getCurrency());
    } 
    
    public function testGetPeriod() {
        $this->assertEquals('1394203949', $this->getInvoiceItem()->getPeriod()->getStart());
        $this->assertEquals('1394203949', $this->getInvoiceItem()->getPeriod()->getEnd());
    }
    
    public function testGetIsProrated() {
        $this->assertFalse($this->getInvoiceItem()->getIsProrated());
    }
    
    public function testGetType() {
        $this->assertEquals('invoiceitem', $this->getInvoiceItem()->getType());
    }    
    
    public function testGetDescription() {
        $this->assertEquals('Foo', $this->getInvoiceItem()->getDescription());
    } 
    
    public function testGetMetadata() {
        $this->assertEquals(new \stdClass(), $this->getInvoiceItem()->getMetadata());
    }
    
    public function testToArray() {
        $this->assertEquals(array(
            'id' => 'ii_3ceeSvsBe2qaNA',
            'object' => 'line_item',
            'type' => 'invoiceitem',
            'livemode' => false,
            'amount' => 1000,
            'currency' => 'gbp',
            'proration' => false,
            'period' => array(
                'start' => 1394203949,
                'end' => 1394203949    
            ),
            'quantity' => null,
            'plan' => null,
            'description' => 'Foo',
            'metadata' => array()            
        ), $this->getInvoiceItem()->__toArray());
    }    
    
    
    /**
     * 
     * @return \webignition\Model\Stripe\Invoice\LineItem\InvoiceItem
     */
    private function getInvoiceItem() {
        return $this->object;
    }
    
}
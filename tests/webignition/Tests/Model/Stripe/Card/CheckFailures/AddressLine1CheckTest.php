<?php

namespace webignition\Tests\Model\Stripe\Card\CheckFailures;

use webignition\Tests\Model\Stripe\ObjectTest;

class AddressLine1CheckTest extends ObjectTest { 
    
    public function testGetCheckFailures() {
        $this->assertEquals(array(
            'address_line1'
        ), $this->getCard()->getCheckFailures());
    }
        
    public function testHasCheckFailures() {
        $this->assertTrue($this->getCard()->hasCheckFailures());
    }    
    
    public function testIsPassedCvcCheck() {
        $this->assertTrue($this->getCard()->isPassedCvcCheck());
    }
    
    public function testIsPassedAddressLine1Check() {
        $this->assertFalse($this->getCard()->isPassedAddressLine1Check());
    }
    
    public function testIsPassedAddressZipCheck() {
        $this->assertTrue($this->getCard()->isPassedAddressZipCheck());
    }    
    
    /**
     * 
     * @return \webignition\Model\Stripe\Card
     */
    private function getCard() {
        return $this->object;
    }
    
}
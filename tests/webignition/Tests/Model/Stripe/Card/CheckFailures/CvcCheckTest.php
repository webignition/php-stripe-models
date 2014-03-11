<?php

namespace webignition\Tests\Model\Stripe\Card\CheckFailures;

use webignition\Tests\Model\Stripe\ObjectTest;

class CvcCheckTest extends ObjectTest { 
    
    public function testGetCheckFailures() {
        $this->assertEquals(array(
            'cvc'
        ), $this->getCard()->getCheckFailures());
    }
        
    public function testHasCheckFailures() {
        $this->assertTrue($this->getCard()->hasCheckFailures());
    }    
    
    public function testIsPassedCvcCheck() {
        $this->assertFalse($this->getCard()->isPassedCvcCheck());
    }
    
    public function testIsPassedAddressLine1Check() {
        $this->assertTrue($this->getCard()->isPassedAddressLine1Check());
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
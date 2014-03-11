<?php

namespace webignition\Tests\Model\Stripe\Card;

use webignition\Tests\Model\Stripe\ObjectTest;

class CheckFailuresTest extends ObjectTest { 
    
    public function testGetCheckFailures() {
        $this->assertEquals(array(
            'cvc'
        ), $this->getCard()->getCheckFailures());
    }
    
    
    public function testHasCheckFailures() {
        $this->assertTrue($this->getCard()->hasCheckFailures());
    }
    
    
    /**
     * 
     * @return \webignition\Model\Stripe\Card
     */
    private function getCard() {
        return $this->object;
    }
    
}
<?php

namespace webignition\Tests\Model\Stripe\Customer;

use webignition\Tests\Model\Stripe\ObjectTest;

class IdOnlyTest extends ObjectTest { 
    
    public function testGetId() {
        $this->assertEquals('cus_3cbU7OeaCpcS9D', $this->getCustomer()->getId());
    }
    
    
    /**
     * 
     * @return \webignition\Model\Stripe\Customer
     */
    private function getCustomer() {
        return $this->object;
    }
    
}
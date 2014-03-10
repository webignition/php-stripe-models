<?php

namespace webignition\Tests\Model\Stripe\Subscription;

use webignition\Tests\Model\Stripe\ObjectTest;

class WasCancelledDuringTrialTest extends ObjectTest { 
    
    public function testWasCancelledDuringTrial() {
        $this->assertTrue($this->getSubscription()->wasCancelledDuringTrial());
    }   
    
    
    /**
     * 
     * @return \webignition\Model\Stripe\Subscription
     */
    private function getSubscription() {
        return $this->object;
    }
    
}
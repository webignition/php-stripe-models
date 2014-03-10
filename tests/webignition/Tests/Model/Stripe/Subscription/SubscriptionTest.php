<?php

namespace webignition\Tests\Model\Stripe\Subscription;

use webignition\Tests\Model\Stripe\ObjectTest;

class SubscriptionTest extends ObjectTest { 
    
    public function testGetId() {
        $this->assertEquals('sub_3ce7tY0vtbIAjb', $this->getSubscription()->getId());
    }    
    
    public function testGetPlan() {
        $this->assertEquals($this->getExpectedPlan(), $this->getSubscription()->getPlan());
    }
    
    public function testGetStart() {
        $this->assertEquals(1394201972, $this->getSubscription()->getStart());
    }
    
    public function testGetStatus() {
        $this->assertEquals('active', $this->getSubscription()->getStatus());
    }
    
    public function testGetIsActive() {
        $this->assertTrue($this->getSubscription()->isActive());
    }
    
    public function testGetIsCancelled() {
        $this->assertFalse($this->getSubscription()->isCancelled());
    }
    
    public function testGetIsTrialing() {
        $this->assertFalse($this->getSubscription()->isTrialing());
    }    
    
    public function testGetCustomerId() {
        $this->assertEquals('cus_3cbU7OeaCpcS9D', $this->getSubscription()->getCustomerId());
    }    
    
    public function testGetCancelAtPeriodEnd() {
        $this->assertFalse($this->getSubscription()->getCancelAtPeriodEnd());
    }
    
    public function testGetCurrentPeriod() {
        $period = $this->getSubscription()->getCurrentPeriod();
        
        $this->assertInstanceOf('webignition\Model\Stripe\Period', $period);
        $this->assertEquals(1394201972, $period->getStart());
        $this->assertEquals(1396880372, $period->getEnd());
    }    
    
    public function testGetEndedAt() {
        $this->assertNull($this->getSubscription()->getEndedAt());
    }
    
    public function testGetTrialPeriod() {
        $this->assertNull($this->getSubscription()->getTrialPeriod());
    }  
    
    public function testGetCancelledAt() {
        $this->assertNull($this->getSubscription()->getCancelledAt());
    }
    
    public function testGetQuantity() {
        $this->assertEquals(1, $this->getSubscription()->getQuantity());
    }    
    
    public function testGetApplicationFeePercent() {
        $this->assertEquals(0, $this->getSubscription()->getApplicationFeePercent());
    }
    
    public function testGetDiscount() {
        $this->assertNull($this->getSubscription()->getDiscount());
    }
    
    public function testWasCancelledDuringTrial() {
        $this->assertFalse($this->getSubscription()->wasCancelledDuringTrial());
    }       
    
    
    public function testToArray() {
        $this->assertEquals(array(          
            'id' => 'sub_3ce7tY0vtbIAjb',
            'plan' => $this->getExpectedPlan()->__toArray(),
            'object' => 'subscription',
            'start' => 1394201972,
            'status' => 'active',
            'customer' => 'cus_3cbU7OeaCpcS9D',
            'cancel_at_period_end' => false,
            'current_period_start' => 1394201972,
            'current_period_end' => 1396880372,
            'ended_at' => null,
            'trial_start' => null,
            'trial_end' => null,
            'canceled_at' => null,
            'quantity' => 1,
            'application_fee_percent' => null,
            'discount' => null,            
        ), $this->getSubscription()->__toArray());
    }      
    
    private function getExpectedPlan() {
        return new \webignition\Model\Stripe\Plan('{
        "interval": "month",
        "name": "Basic",
        "created": 1371118751,
        "amount": 0,
        "currency": "gbp",
        "id": "basic",
        "object": "plan",
        "livemode": false,
        "interval_count": 1,
        "trial_period_days": null,
        "metadata": {}
      }');       
    }    
    
    
    /**
     * 
     * @return \webignition\Model\Stripe\Subscription
     */
    private function getSubscription() {
        return $this->object;
    }
    
}
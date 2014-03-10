<?php

namespace webignition\Tests\Model\Stripe\LineItem;

use webignition\Tests\Model\Stripe\ObjectTest;

class SubscriptionTest extends ObjectTest { 
    
    public function testGetId() {
        $this->assertEquals('sub_3ceX8jHwVquCNo', $this->getSubscriptionLineItem()->getId());
    }   
    
    public function testGetAmount() {
        $this->assertEquals(1000, $this->getSubscriptionLineItem()->getAmount());
    }  
    
    public function testGetCurrency() {
        $this->assertEquals('gbp', $this->getSubscriptionLineItem()->getCurrency());
    } 
    
    public function testGetPeriod() {
        $this->assertEquals('1394203572', $this->getSubscriptionLineItem()->getPeriod()->getStart());
        $this->assertEquals('1396795572', $this->getSubscriptionLineItem()->getPeriod()->getEnd());
    }
    
    public function testGetIsProrated() {
        $this->assertFalse($this->getSubscriptionLineItem()->getIsProrated());
    }
    
    public function testGetType() {
        $this->assertEquals('subscription', $this->getSubscriptionLineItem()->getType());
    }    
    
    public function testGetPlan() {
        $this->assertEquals($this->getExpectedPlan(), $this->getSubscriptionLineItem()->getPlan());
    } 
    
    public function testGetQuantity() {
        $this->assertEquals(1, $this->getSubscriptionLineItem()->getQuantity());
    }
    
    public function testToArray() {
        $this->assertEquals(array(
            'id' => 'sub_3ceX8jHwVquCNo',
            'object' => 'line_item',
            'type' => 'subscription',
            'livemode' => false,
            'amount' => 1000,
            'currency' => 'gbp',
            'proration' => false,
            'period' => array(
                'start' => 1394203572,
                'end' => 1396795572    
            ),
            'quantity' => 1,
            'plan' => $this->getExpectedPlan()->__toArray(),
            'description' => null,
            'metadata' => array()           
        ), $this->getSubscriptionLineItem()->__toArray());
    }
    
    
    private function getExpectedPlan() {
        return new \webignition\Model\Stripe\Plan('{
        "interval": "month",
        "name": "Personal",
        "created": 1370600314,
        "amount": 900,
        "currency": "gbp",
        "id": "personal-9",
        "object": "plan",
        "livemode": false,
        "interval_count": 1,
        "trial_period_days": 30,
        "metadata": {}
      }');       
    }
    
    
    /**
     * 
     * @return \webignition\Model\Stripe\Invoice\LineItem\Subscription
     */
    private function getSubscriptionLineItem() {
        return $this->object;
    }
    
}
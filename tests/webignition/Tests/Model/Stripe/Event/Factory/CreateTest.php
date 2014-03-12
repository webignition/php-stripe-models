<?php

namespace webignition\Tests\Model\Stripe\Event\Factory;

use webignition\Model\Stripe\Event\Factory;
use webignition\Tests\Model\Stripe\BaseTest;

class CreateTest extends BaseTest {
    
    public function testCustomerSubscriptionUpdatedPlanChange() {
        $event = Factory::create($this->getFixture('customer.subscription.updated.planchange.json'));
        
        $this->assertInstanceOf('webignition\Model\Stripe\Event\CustomerSubscriptionUpdated', $event);
        $this->assertTrue($event->isPlanChange());
    }
    
    public function testCustomerSubscriptionUpdatedStatusChange() {
        $event = Factory::create($this->getFixture('customer.subscription.updated.statuschange.json'));
        
        $this->assertInstanceOf('webignition\Model\Stripe\Event\CustomerSubscriptionUpdated', $event);
        $this->assertTrue($event->isStatusChange());
        $this->assertEquals('trialing:active', $event->getStatusChange());
        $this->assertTrue($event->hasStatusChange('trialing:active'));
    }    
    
}
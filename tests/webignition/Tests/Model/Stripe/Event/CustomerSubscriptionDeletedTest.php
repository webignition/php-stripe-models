<?php

namespace webignition\Tests\Model\Stripe\Event;

use webignition\Tests\Model\Stripe\ObjectTest;

class CustomerSubscriptionDeletedTest extends ObjectTest { 

    public function testGetId() {
        $this->assertEquals('evt_3ZEZ8gI7aPSU7O', $this->getEvent()->getId());
    }    
    
    public function testGetCreated() {
        $this->assertEquals(1393415025, $this->getEvent()->getCreated());
    }
    
    public function testGetData() {
        $data = $this->getEvent()->getDataObject();
        $subscription = $data->getObject();
        
        $this->assertInstanceOf('webignition\Model\Stripe\Event\Data', $data);
        $this->assertInstanceOf('webignition\Model\Stripe\Subscription', $subscription);
        
        $this->assertFalse($data->hasPreviousAttributes());
    }
    
    public function testGetType() {
        $this->assertEquals('customer.subscription.deleted', $this->getEvent()->getType());
    }
    
    public function testGetPendingWebhooks() {
        $this->assertEquals(1, $this->getEvent()->getPendingWebhooks());
    }
    
    public function testGetRequestId() {
        $this->assertTrue($this->getEvent()->hasRequestId());
        $this->assertEquals('iar_3ZEZdedNZchQEr', $this->getEvent()->getRequestId());
    }
    
    public function testToArray() {        
        $this->assertEquals(array(  
            'id' => 'evt_3ZEZ8gI7aPSU7O',
            'created' => 1393415025,
            'livemode' => false,
            'type' => 'customer.subscription.deleted',
            'data' => array(
                'object' => array(
                    'id' => 'sub_3ZEYOwNASZBuIz',
                    'plan' => array(
                        'interval' => 'month',
                        'name' => 'Personal',
                        'created' => 1370600314,
                        'amount' => 900,
                        'currency' => 'gbp',
                        'id' => 'personal-9',
                        'object' => 'plan',
                        'livemode' => false,
                        'interval_count' => 1,
                        'trial_period_days' => 30,
                        'metadata' => array()            
                    ),
                    'object' => 'subscription',
                    'start' => 1393414985,
                    'status' => 'canceled',
                    'customer' => 'b58996c504c5638798eb6b511e6f49af',
                    'cancel_at_period_end' => false,
                    'current_period_start' => 1393414985,
                    'current_period_end' => 1396006949,
                    'ended_at' => 1393415025,
                    'trial_start' => 1393414985,
                    'trial_end' => 1396006949,
                    'canceled_at' => 1393415025,
                    'quantity' => 1,
                    'application_fee_percent' => null,
                    'discount' => null,        
                )
            ),
            'object' => 'event',
            'pending_webhooks' => 1,
            'request' => 'iar_3ZEZdedNZchQEr',
        ), $this->getEvent()->__toArray());
    }    
    
    
    /**
     * 
     * @return \webignition\Model\Stripe\Event\Event
     */
    private function getEvent() {
        return $this->object;
    }
    
}
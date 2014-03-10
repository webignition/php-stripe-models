<?php

namespace webignition\Tests\Model\Stripe\Customer;

use webignition\Tests\Model\Stripe\ObjectTest;

class NoSubscriptionNoCardTest extends ObjectTest { 
    
    public function testGetId() {
        $this->assertEquals('cus_3cbU7OeaCpcS9D', $this->getCustomer()->getId());
    }    
    
    public function testHasCard() {
        $this->assertFalse($this->getCustomer()->hasCard());
    }    
    
    public function testGetActiveCard() {
        $this->assertNull($this->getCustomer()->getActiveCard());
    }
    
    public function testHasSubscription() {
        $this->assertFalse($this->getCustomer()->hasSubscription());
    }    
    
    public function testGetSubscription() {
        $this->assertNull($this->getCustomer()->getSubscription());
    }    
    
    public function testGetSubscriptions() {
        $this->assertEquals(0, $this->getCustomer()->getSubscriptions()->getItems()->count());
    }    
    
    public function testToArray() {
        $this->assertEquals(array(
            'object' => 'customer',
            'created' => 1394192199,
            'id' => 'cus_3cbU7OeaCpcS9D',
            'livemode' => false,
            'description' => null,
            'email' => 'user@example.com',
            'delinquent' => false,
            'metadata' => array(),
            'subscriptions' => array(
                'object' => 'list',
                'count' => 0,
                'url' => '/v1/customers/cus_3cbU7OeaCpcS9D/subscriptions',
                'data' => array()
            ),
            'discount' => null,
            'account_balance' => 0,
            'currency' => 'gbp',
            'cards' => array(
                'object' => 'list',
                'count' => 0,
                'url' => '/v1/customers/cus_3cbU7OeaCpcS9D/cards',
                'data' => array()    
            ),
            'default_card' => null
        ), $this->getCustomer()->__toArray());
    }
    
    
    /**
     * 
     * @return \webignition\Model\Stripe\Customer
     */
    private function getCustomer() {
        return $this->object;
    }
    
}
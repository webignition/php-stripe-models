<?php

namespace webignition\Tests\Model\Stripe\Customer;

use webignition\Tests\Model\Stripe\ObjectTest;

class WithSubscriptionWithCardTest extends ObjectTest { 
    
    public function testGetId() {
        $this->assertEquals('cus_3cbU7OeaCpcS9D', $this->getCustomer()->getId());
    }    
    
    public function testHasCard() {
        $this->assertTrue($this->getCustomer()->hasCard());
    }    
    
    public function testGetActiveCard() {
        $this->assertInstanceOf('webignition\Model\Stripe\Card', $this->getCustomer()->getActiveCard());
    }
    
    public function testHasActiveCard() {
        $this->assertTrue($this->getCustomer()->hasActiveCard());
    }    
    
    public function testHasSubscription() {
        $this->assertTrue($this->getCustomer()->hasSubscription());
    }    
    
    public function testGetSubscription() {
        $this->assertInstanceOf('webignition\Model\Stripe\Subscription', $this->getCustomer()->getSubscription());
    }    
    
    public function testGetSubscriptions() {
        $this->assertEquals(1, $this->getCustomer()->getSubscriptions()->getItems()->count());
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
                'count' => 1,
                'url' => '/v1/customers/cus_3cbU7OeaCpcS9D/subscriptions',
                'data' => array(
                    array(
                        'id' => 'sub_3ceX8jHwVquCNo',
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
                        'start' => 1394203572,
                        'status' => 'trialing',
                        'customer' => 'cus_3cbU7OeaCpcS9D',
                        'cancel_at_period_end' => false,
                        'current_period_start' => 1394203572,
                        'current_period_end' => 1396795572,
                        'ended_at' => null,
                        'trial_start' => 1394203572,
                        'trial_end' => 1396795572,
                        'canceled_at' => null,
                        'quantity' => 1,
                        'application_fee_percent' => null,
                        'discount' => null        
                    )
                )                
            ),
            'discount' => null,
            'account_balance' => 0,
            'currency' => 'gbp',
            'cards' => array(
                'object' => 'list',
                'count' => 1,
                'url' => '/v1/customers/cus_3cbU7OeaCpcS9D/cards',
                'data' => array(
                    array(
                        'id' => 'card_3ceen9ACYNeol8',
                        'object' => 'card',
                        'last4' => '4242',
                        'type' => 'Visa',
                        'exp_month' => 12,
                        'exp_year' => 2024,
                        'fingerprint' => '7y5WDQllCuyzj32D',
                        'customer' => 'cus_3cbU7OeaCpcS9D',
                        'country' => 'US',
                        'name' => null,
                        'address_line1' => null,
                        'address_line2' => null,
                        'address_city' => null,
                        'address_state' => null,
                        'address_zip' => null,
                        'address_country' => null,
                        'cvc_check' => 'pass',
                        'address_line1_check' => null,
                        'address_zip_check' => null,                          
                    )
                )    
            ),
            'default_card' => 'card_3ceen9ACYNeol8',
            'active_card' => array(
                'id' => 'card_3ceen9ACYNeol8',
                'object' => 'card',
                'last4' => '4242',
                'type' => 'Visa',
                'exp_month' => 12,
                'exp_year' => 2024,
                'fingerprint' => '7y5WDQllCuyzj32D',
                'customer' => 'cus_3cbU7OeaCpcS9D',
                'country' => 'US',
                'name' => null,
                'address_line1' => null,
                'address_line2' => null,
                'address_city' => null,
                'address_state' => null,
                'address_zip' => null,
                'address_country' => null,
                'cvc_check' => 'pass',
                'address_line1_check' => null,
                'address_zip_check' => null,             
            ),
            'subscription' => array(
                'id' => 'sub_3ceX8jHwVquCNo',
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
                'start' => 1394203572,
                'status' => 'trialing',
                'customer' => 'cus_3cbU7OeaCpcS9D',
                'cancel_at_period_end' => false,
                'current_period_start' => 1394203572,
                'current_period_end' => 1396795572,
                'ended_at' => null,
                'trial_start' => 1394203572,
                'trial_end' => 1396795572,
                'canceled_at' => null,
                'quantity' => 1,
                'application_fee_percent' => null,
                'discount' => null                   
            )
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
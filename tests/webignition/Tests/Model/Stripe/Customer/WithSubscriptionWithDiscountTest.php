<?php

namespace webignition\Tests\Model\Stripe\Customer;

use webignition\Tests\Model\Stripe\ObjectTest;

class WithSubscriptionWithDiscountTest extends ObjectTest {
    
    public function testGetId() {
        $this->assertEquals('cus_4ZpdOIgXTGsiax', $this->getCustomer()->getId());
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

    public function testHasDiscount() {
        $this->assertTrue($this->getCustomer()->hasDiscount());
    }

    public function testGetDiscount() {
        $this->assertInstanceOf('webignition\Model\Stripe\Discount', $this->getCustomer()->getDiscount());
    }


    public function testToArray() {
        $this->assertEquals(array(
            'object' => 'customer',
            'created' => 1407852586,
            'id' => 'cus_4ZpdOIgXTGsiax',
            'livemode' => false,
            'description' => null,
            'email' => 'user@example.com',
            'delinquent' => false,
            'metadata' => array(),
            'subscriptions' => array(
                'object' => 'list',
                'count' => 1,
                'url' => '/v1/customers/cus_4ZpdOIgXTGsiax/subscriptions',
                'data' => array(
                    array(
                        'id' => 'sub_4ZpdfFhUCGlITA',
                        'plan' => array(
                            'interval' => 'month',
                            'name' => 'Agency',
                            'created' => 1370600333,
                            'amount' => 1900,
                            'currency' => 'gbp',
                            'id' => 'agency-19',
                            'object' => 'plan',
                            'livemode' => false,
                            'interval_count' => 1,
                            'trial_period_days' => 30,
                            'metadata' => array(),
                            'statement_description' => null
                        ),
                        'object' => 'subscription',
                        'start' => 1407852588,
                        'status' => 'trialing',
                        'customer' => 'cus_4ZpdOIgXTGsiax',
                        'cancel_at_period_end' => false,
                        'current_period_start' => 1407852588,
                        'current_period_end' => 1410444380,
                        'ended_at' => null,
                        'trial_start' => 1407852588,
                        'trial_end' => 1410444380,
                        'canceled_at' => null,
                        'quantity' => 1,
                        'application_fee_percent' => null,
                        'discount' => null,
                        'metadata' => array()
                    )
                ),
                'total_count' => 1,
                'has_more' => false
            ),
            'discount' => array(
                'coupon' => array(
                    'id' => 'TMS',
                    'created' => 1407422003,
                    'percent_off' => 20,
                    'amount_off' => null,
                    'currency' => null,
                    'object' => 'coupon',
                    'livemode' => false,
                    'duration' => 'forever',
                    'redeem_by' => null,
                    'max_redemptions' => null,
                    'times_redeemed' => 7,
                    'duration_in_months' => null,
                    'valid' => true,
                    'metadata' => array()
                ),
                'start' => 1407852586,
                'object' => 'discount',
                'customer' => 'cus_4ZpdOIgXTGsiax',
                'subscription' => null,
                'end' => null
            ),
            'account_balance' => 0,
            'currency' => 'gbp',
            'cards' => array(
                'object' => 'list',
                'total_count' => 0,
                'has_more' => false,
                'url' => '/v1/customers/cus_4ZpdOIgXTGsiax/cards',
                'data' => array(),
                'count' => 0
            ),
            'default_card' => null,
            'active_card' => null,
            'subscription' => array(
                'id' => 'sub_4ZpdfFhUCGlITA',
                'plan' => array(
                    'interval' => 'month',
                    'name' => 'Agency',
                    'created' => 1370600333,
                    'amount' => 1900,
                    'currency' => 'gbp',
                    'id' => 'agency-19',
                    'object' => 'plan',
                    'livemode' => false,
                    'interval_count' => 1,
                    'trial_period_days' => 30,
                    'metadata' => array(),
                    'statement_description' => null
                ),
                'object' => 'subscription',
                'start' => 1407852588,
                'status' => 'trialing',
                'customer' => 'cus_4ZpdOIgXTGsiax',
                'cancel_at_period_end' => false,
                'current_period_start' => 1407852588,
                'current_period_end' => 1410444380,
                'ended_at' => null,
                'trial_start' => 1407852588,
                'trial_end' => 1410444380,
                'canceled_at' => null,
                'quantity' => 1,
                'application_fee_percent' => null,
                'discount' => null,
                'metadata' => array()
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
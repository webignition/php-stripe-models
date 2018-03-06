<?php

namespace webignition\Tests\Model\Stripe;

use webignition\Model\Stripe\Card;
use webignition\Model\Stripe\Customer;
use webignition\Model\Stripe\Discount;
use webignition\Model\Stripe\Subscription;

class CustomerTest extends AbstractBaseTest
{
    /**
     * @dataProvider getCustomerPropertiesDataProvider
     *
     * @param string $fixture
     * @param array $expectedCustomerData
     */
    public function testGetCustomerProperties($fixture, array $expectedCustomerData)
    {
        $customer = new Customer($this->loadFixture($fixture));

        $this->assertEquals($expectedCustomerData['id'], $customer->getId());
        $this->assertEquals($expectedCustomerData['has_card'], $customer->hasCard());

        if ($expectedCustomerData['has_subscription']) {
            $this->assertTrue($customer->hasSubscription());
            $this->assertInstanceOf(Subscription::class, $customer->getSubscription());
            $this->assertNotEmpty($customer->getSubscriptions()->getItems());
        } else {
            $this->assertFalse($customer->hasSubscription());
            $this->assertNull($customer->getSubscription());
            $this->assertEmpty($customer->getSubscriptions()->getItems());
        }

        if ($expectedCustomerData['has_active_card']) {
            $this->assertTrue($customer->hasActiveCard());
            $this->assertInstanceOf(Card::class, $customer->getActiveCard());
            $this->assertNotEmpty($customer->getCards()->getItems());
        } else {
            $this->assertFalse($customer->hasActiveCard());
            $this->assertNull($customer->getActiveCard());
            $this->assertEmpty($customer->getCards()->getItems());
        }

        if ($expectedCustomerData['has_discount']) {
            $this->assertTrue($customer->hasDiscount());
            $this->assertInstanceOf(Discount::class, $customer->getDiscount());
        } else {
            $this->assertFalse($customer->hasDiscount());
            $this->assertNull($customer->getDiscount());
        }

        $customerAsArray = $customer->__toArray();

        $this->assertEquals($expectedCustomerData['array_subset']['subscriptions'], $customerAsArray['subscriptions']);
        $this->assertEquals($expectedCustomerData['array_subset']['cards'], $customerAsArray['cards']);
    }

    /**
     * @return array
     */
    public function getCustomerPropertiesDataProvider()
    {
        return [
            'no subscription no card' => [
                'fixture' => '/Customer/customer.no-subscription-no-card.json',
                'expectedCustomerData' => [
                    'id' => 'cus_3cbU7OeaCpcS9D',
                    'has_card' => false,
                    'has_subscription' => false,
                    'has_active_card' => false,
                    'has_discount' => false,
                    'array_subset' => [
                        'subscriptions' => [
                            'object' => 'list',
                            'count' => 0,
                            'url' => '/v1/customers/cus_3cbU7OeaCpcS9D/subscriptions',
                            'data' => [],
                        ],
                        'cards' => [
                            'object' => 'list',
                            'count' => 0,
                            'url' => '/v1/customers/cus_3cbU7OeaCpcS9D/cards',
                            'data' => [],
                        ],
                    ],
                ],
            ],
            'has subscription no card' => [
                'fixture' => '/Customer/customer.with-subscription-no-card.json',
                'expectedCustomerData' => [
                    'id' => 'cus_3cbU7OeaCpcS9D',
                    'has_card' => false,
                    'has_subscription' => true,
                    'has_active_card' => false,
                    'has_discount' => false,
                    'array_subset' => [
                        'subscriptions' => [
                            'object' => 'list',
                            'count' => 1,
                            'url' => '/v1/customers/cus_3cbU7OeaCpcS9D/subscriptions',
                            'data' => [
                                [
                                    'id' => 'sub_3ceX8jHwVquCNo',
                                    'plan' => [
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
                                        'metadata' => [],
                                    ],
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
                                    'discount' => null,
                                ]
                            ],
                        ],
                        'cards' => [
                            'object' => 'list',
                            'count' => 0,
                            'url' => '/v1/customers/cus_3cbU7OeaCpcS9D/cards',
                            'data' => [],
                        ],
                    ],
                ],
            ],
            'has subscription has card' => [
                'fixture' => '/Customer/customer.with-subscription-with-card.json',
                'expectedCustomerData' => [
                    'id' => 'cus_3cbU7OeaCpcS9D',
                    'has_card' => true,
                    'has_subscription' => true,
                    'has_active_card' => true,
                    'has_discount' => false,
                    'array_subset' => [
                        'subscriptions' => [
                            'object' => 'list',
                            'count' => 1,
                            'url' => '/v1/customers/cus_3cbU7OeaCpcS9D/subscriptions',
                            'data' => [
                                [
                                    'id' => 'sub_3ceX8jHwVquCNo',
                                    'plan' => [
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
                                        'metadata' => [],
                                    ],
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
                                    'discount' => null,
                                ]
                            ],
                        ],
                        'cards' => [
                            'object' => 'list',
                            'count' => 1,
                            'url' => '/v1/customers/cus_3cbU7OeaCpcS9D/cards',
                            'data' => [
                                [
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
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'has subscription no card has discount' => [
                'fixture' => '/Customer/customer.with-subscription-with-discount.json',
                'expectedCustomerData' => [
                    'id' => 'cus_4ZpdOIgXTGsiax',
                    'has_card' => false,
                    'has_subscription' => true,
                    'has_active_card' => false,
                    'has_discount' => true,
                    'array_subset' => [
                        'subscriptions' => [
                            'object' => 'list',
                            'count' => 1,
                            'url' => '/v1/customers/cus_4ZpdOIgXTGsiax/subscriptions',
                            'data' => [
                                [
                                    'id' => 'sub_4ZpdfFhUCGlITA',
                                    'plan' => [
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
                                        'metadata' => [],
                                        'statement_description' => null,
                                    ],
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
                                    'metadata' => [],
                                ]
                            ],
                            'total_count' => 1,
                            'has_more' => false,
                        ],
                        'cards' => [
                            'object' => 'list',
                            'count' => 0,
                            'url' => '/v1/customers/cus_4ZpdOIgXTGsiax/cards',
                            'data' => [],
                            'total_count' => 0,
                            'has_more' => false,
                        ],
                    ],
                ],
            ],
        ];
    }
}

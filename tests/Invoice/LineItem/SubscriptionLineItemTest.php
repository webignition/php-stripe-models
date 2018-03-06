<?php

namespace webignition\Tests\Model\Stripe\Invoice\LineItem;

use webignition\Model\Stripe\Invoice\LineItem\Subscription as LineItemSubscription;
use webignition\Model\Stripe\Plan;

class SubscriptionLineItemTest extends AbstractLineItemTest
{
    public function testGetLineItemSubscriptionProperties()
    {
        $lineItemSubscription = new LineItemSubscription(
            $this->loadFixture('/Invoice/LineItem/subscription-line-item.json')
        );

        $this->assertEquals(1, $lineItemSubscription->getQuantity());
        $this->assertInstanceOf(Plan::class, $lineItemSubscription->getPlan());

        $this->assertLineItemProperties(
            [
                'id' => 'sub_3ceX8jHwVquCNo',
                'amount' => 0,
                'currency' => 'gbp',
                'is_prorated' => false,
                'type' => 'subscription',
                'period' => [
                    'start' => 1394203572,
                    'end' => 1396795572,
                ],
            ],
            $lineItemSubscription
        );
    }
}

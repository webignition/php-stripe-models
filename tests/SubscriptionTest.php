<?php

namespace webignition\Tests\Model\Stripe;

use webignition\Model\Stripe\Period;
use webignition\Model\Stripe\Plan;
use webignition\Model\Stripe\Subscription;

class SubscriptionTest extends AbstractBaseTest
{
    /**
     * @dataProvider getSubscriptionPropertiesDataProvider
     *
     * @param string $fixture
     * @param array $expectedSubscriptionData
     */
    public function testGetSubscriptionProperties($fixture, array $expectedSubscriptionData)
    {
        $subscription = new Subscription($this->loadFixture($fixture));

        $this->assertEquals($expectedSubscriptionData['id'], $subscription->getId());
        $this->assertEquals($expectedSubscriptionData['start'], $subscription->getStart());
        $this->assertEquals($expectedSubscriptionData['status'], $subscription->getStatus());
        $this->assertEquals($expectedSubscriptionData['is_active'], $subscription->isActive());
        $this->assertEquals($expectedSubscriptionData['is_trialing'], $subscription->isTrialing());
        $this->assertEquals($expectedSubscriptionData['is_cancelled'], $subscription->isCancelled());
        $this->assertEquals($expectedSubscriptionData['cancel_at_period_end'], $subscription->getCancelAtPeriodEnd());
        $this->assertEquals($expectedSubscriptionData['ended_at'], $subscription->getEndedAt());
        $this->assertEquals($expectedSubscriptionData['quantity'], $subscription->getQuantity());
        $this->assertEquals($expectedSubscriptionData['discount'], $subscription->getDiscount());
        $this->assertEquals($expectedSubscriptionData['discount'], $subscription->getDiscount());
        $this->assertEquals($expectedSubscriptionData['customer'], $subscription->getCustomerId());

        $this->assertEquals(
            $expectedSubscriptionData['was_cancelled_during_trial'],
            $subscription->wasCancelledDuringTrial()
        );

        $this->assertEquals(
            $expectedSubscriptionData['application_fee_percent'],
            $subscription->getApplicationFeePercent()
        );

        if (empty($expectedSubscriptionData['trial_period'])) {
            $this->assertNull($subscription->getTrialPeriod());
            $this->assertFalse($subscription->hasTrialPeriod());
        } else {
            $trialPeriod = $subscription->getTrialPeriod();

            $this->assertInstanceOf(Period::class, $trialPeriod);
            $this->assertTrue($subscription->hasTrialPeriod());
            $this->assertEquals($expectedSubscriptionData['trial_period']['start'], $trialPeriod->getStart());
            $this->assertEquals($expectedSubscriptionData['trial_period']['end'], $trialPeriod->getEnd());
        }

        $plan = $subscription->getPlan();
        $this->assertInstanceOf(Plan::class, $plan);
        $this->assertEquals($expectedSubscriptionData['plan_name'], $plan->getName());

        $currentPeriod = $subscription->getCurrentPeriod();
        $this->assertInstanceOf(Period::class, $currentPeriod);
        $this->assertEquals($expectedSubscriptionData['current_period']['start'], $currentPeriod->getStart());
        $this->assertEquals($expectedSubscriptionData['current_period']['end'], $currentPeriod->getEnd());

        $this->assertEmpty($subscription->getMetadata());
    }

    /**
     * @return array
     */
    public function getSubscriptionPropertiesDataProvider()
    {
        return [
            'active' => [
                'fixture' => '/Subscription/subscription.active.json',
                'expectedSubscriptionData' => [
                    'id' => 'sub_3ce7tY0vtbIAjb',
                    'plan_name' => 'Agency',
                    'start' => 1394201972,
                    'status' => 'active',
                    'is_active' => true,
                    'is_trialing' => false,
                    'is_cancelled' => false,
                    'cancel_at_period_end' => false,
                    'ended_at' => null,
                    'trial_period' => null,
                    'quantity' => 1,
                    'application_fee_percent' => null,
                    'discount' => null,
                    'was_cancelled_during_trial' => false,
                    'current_period' => [
                        'start' => 1394201972,
                        'end' => 1396880372,
                    ],
                    'customer' => 'cus_3cbU7OeaCpcS9D',
                ],
            ],
            'trialing, cancel_at_period_end=false' => [
                'fixture' => '/Subscription/subscription.trialing.cancel_at_period_end=false.json',
                'expectedSubscriptionData' => [
                    'id' => 'sub_3ce7tY0vtbIAjb',
                    'plan_name' => 'Personal',
                    'start' => 1394201972,
                    'status' => 'trialing',
                    'is_active' => false,
                    'is_trialing' => true,
                    'is_cancelled' => false,
                    'cancel_at_period_end' => false,
                    'ended_at' => null,
                    'trial_period' => [
                        'start' => 1394201973,
                        'end' => 1396880373,
                    ],
                    'quantity' => 1,
                    'application_fee_percent' => null,
                    'discount' => null,
                    'was_cancelled_during_trial' => false,
                    'current_period' => [
                        'start' => 1394201972,
                        'end' => 1396880372,
                    ],
                    'customer' => 'cus_3cbU7OeaCpcS9D',
                ],
            ],
            'trialing, cancel_at_period_end=true' => [
                'fixture' => '/Subscription/subscription.trialing.cancel_at_period_end=true.json',
                'expectedSubscriptionData' => [
                    'id' => 'sub_3ce7tY0vtbIAjb',
                    'plan_name' => 'Personal',
                    'start' => 1394201972,
                    'status' => 'trialing',
                    'is_active' => false,
                    'is_trialing' => true,
                    'is_cancelled' => false,
                    'cancel_at_period_end' => true,
                    'ended_at' => null,
                    'trial_period' => [
                        'start' => 1394201973,
                        'end' => 1396880373,
                    ],
                    'quantity' => 1,
                    'application_fee_percent' => null,
                    'discount' => null,
                    'was_cancelled_during_trial' => false,
                    'current_period' => [
                        'start' => 1394201972,
                        'end' => 1396880372,
                    ],
                    'customer' => 'cus_3cbU7OeaCpcS9D',
                ],
            ],
            'cancelled during trial' => [
                'fixture' => '/Subscription/subscription.canceled_during_trial.json',
                'expectedSubscriptionData' => [
                    'id' => 'sub_3ce7tY0vtbIAjb',
                    'plan_name' => 'Personal',
                    'start' => 1394201972,
                    'status' => 'canceled',
                    'is_active' => false,
                    'is_trialing' => false,
                    'is_cancelled' => true,
                    'cancel_at_period_end' => false,
                    'ended_at' => 1394201975,
                    'trial_period' => [
                        'start' => 1394201973,
                        'end' => 1396880373,
                    ],
                    'quantity' => 1,
                    'application_fee_percent' => null,
                    'discount' => null,
                    'was_cancelled_during_trial' => true,
                    'current_period' => [
                        'start' => 1394201972,
                        'end' => 1396880372,
                    ],
                    'customer' => 'cus_3cbU7OeaCpcS9D',
                ],
            ],
            'cancelled after trial' => [
                'fixture' => '/Subscription/subscription.canceled_after_trial.json',
                'expectedSubscriptionData' => [
                    'id' => 'sub_3ce7tY0vtbIAjb',
                    'plan_name' => 'Personal',
                    'start' => 1394201972,
                    'status' => 'canceled',
                    'is_active' => false,
                    'is_trialing' => false,
                    'is_cancelled' => true,
                    'cancel_at_period_end' => false,
                    'ended_at' => 1396880375,
                    'trial_period' => null,
                    'quantity' => 1,
                    'application_fee_percent' => null,
                    'discount' => null,
                    'was_cancelled_during_trial' => false,
                    'current_period' => [
                        'start' => 1394201972,
                        'end' => 1396880372,
                    ],
                    'customer' => 'cus_3cbU7OeaCpcS9D',
                ],
            ],
        ];
    }
}

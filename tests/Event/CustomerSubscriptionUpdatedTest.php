<?php

namespace webignition\Tests\Model\Stripe\Event;

use webignition\Model\Stripe\Event\CustomerSubscriptionUpdated;
use webignition\Model\Stripe\Plan;

class CustomerSubscriptionUpdatedTest extends AbstractEventTest
{
    /**
     * @dataProvider getEventPropertiesDataProvider
     *
     * @param string $fixture
     * @param array $expectedEventProperties
     */
    public function testGetEventProperties($fixture, array $expectedEventProperties)
    {
        $event = new CustomerSubscriptionUpdated($this->loadFixture($fixture));

        $this->assertEquals($expectedEventProperties['is_plan_change'], $event->isPlanChange());
        $this->assertEquals($expectedEventProperties['is_status_change'], $event->isStatusChange());

        if (isset($expectedEventProperties['get_status_change'])) {
            $this->assertEquals($expectedEventProperties['get_status_change'], $event->getStatusChange());
        } else {
            $this->assertNull($event->getStatusChange());
        }

        if (isset($expectedEventProperties['has_status_change'])) {
            $this->assertTrue($event->hasStatusChange($expectedEventProperties['has_status_change']));
        }

        if (isset($expectedEventProperties['previous_plan'])) {
            /* @var Plan $plan */
            $plan = $event->getDataObject()->getPreviousAttributes()->get('plan');

            $this->assertInstanceOf(Plan::class, $plan);
            $this->assertEquals($expectedEventProperties['previous_plan'], $plan->getName());
        }

        $this->assertEventProperties(
            [
                'id' => 'evt_2Qom1oCNf7m5vR',
                'created' => '1377174289',
                'type' => 'customer.subscription.updated',
                'pending_webhooks' => 1,
                'request_id' => 'iar_2QomKs9vMVY0bC',
                'has_request_id' => true,
            ],
            $event
        );
    }

    /**
     * @return array
     */
    public function getEventPropertiesDataProvider()
    {
        return [
            'plan change' => [
                'fixture' => '/Event/customer.subscription.updated.planchange.json',
                'expectedEventProperties' => [
                    'is_plan_change' => true,
                    'is_status_change' => false,
                    'previous_plan' => 'Personal',
                ],
            ],
            'status change' => [
                'fixture' => '/Event/customer.subscription.updated.statuschange.json',
                'expectedEventProperties' => [
                    'is_plan_change' => false,
                    'is_status_change' => true,
                    'get_status_change' => 'trialling:active',
                    'has_status_change' => 'trialling:active',
                ],
            ],
            'not plan change not status change' => [
                'fixture' => '/Event/customer.subscription.updated.notplanchangenotstatuschange.json',
                'expectedEventProperties' => [
                    'is_plan_change' => false,
                    'is_status_change' => false,
                ],
            ],
        ];
    }
}

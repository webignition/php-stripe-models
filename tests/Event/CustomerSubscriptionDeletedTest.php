<?php

namespace webignition\Tests\Model\Stripe\Event;

use webignition\Model\Stripe\Event\Data;
use webignition\Model\Stripe\Event\Event;
use webignition\Model\Stripe\Subscription;

class CustomerSubscriptionDeletedTest extends AbstractEventTest
{
    public function testGetEventProperties()
    {
        $event = new Event($this->loadFixture('/Event/customer.subscription.deleted.json'));

        $this->assertInstanceOf(Event::class, $event);

        $data = $event->getDataObject();
        $subscription = $data->getObject();

        $this->assertInstanceOf(Data::class, $data);
        $this->assertInstanceOf(Subscription::class, $subscription);

        $this->assertFalse($data->hasPreviousAttributes());

        $this->assertEventProperties(
            [
                'id' => 'evt_3ZEZ8gI7aPSU7O',
                'created' => '1393415025',
                'type' => 'customer.subscription.deleted',
                'pending_webhooks' => 1,
                'request_id' => 'iar_3ZEZdedNZchQEr',
                'has_request_id' => true,
            ],
            $event
        );
    }
}

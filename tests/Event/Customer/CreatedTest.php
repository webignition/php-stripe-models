<?php

namespace webignition\Tests\Model\Stripe\Event\Customer;

use webignition\Model\Stripe\Customer;
use webignition\Model\Stripe\Event\Customer\Created;
use webignition\Tests\Model\Stripe\Event\AbstractEventTest;

class CreatedTest extends AbstractEventTest
{
    public function testGetEventProperties()
    {
        $event = new Created($this->loadFixture('/Event/customer.created.json'));

        $this->assertInstanceOf(Customer::class, $event->getCustomer());

        $this->assertEventProperties(
            [
                'id' => 'evt_4aAC1hCV5AzI2b',
                'created' => '1407929093',
                'type' => 'customer.created',
                'pending_webhooks' => 1,
                'request_id' => 'iar_4aACj3P5wXqUQ9',
                'has_request_id' => true,
            ],
            $event
        );
    }
}

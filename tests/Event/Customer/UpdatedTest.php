<?php

namespace webignition\Tests\Model\Stripe\Event\Customer;

use webignition\Model\Stripe\Customer;
use webignition\Model\Stripe\Event\Customer\Updated;
use webignition\Tests\Model\Stripe\Event\AbstractEventTest;

class UpdatedTest extends AbstractEventTest
{
    public function testGetCustomer()
    {
        $event = new Updated($this->loadFixture('/Event/customer.updated.json'));

        $this->assertInstanceOf(Customer::class, $event->getCustomer());

        $this->assertEventProperties(
            [
                'id' => 'evt_4cLPsxfYedI7Cd',
                'created' => '1408432065',
                'type' => 'customer.updated',
                'pending_webhooks' => 1,
                'request_id' => 'iar_4cLPRPfMIleyMM',
                'has_request_id' => true,
            ],
            $event
        );
    }
}

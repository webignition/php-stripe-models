<?php

namespace webignition\Tests\Model\Stripe\Event;

use webignition\Model\Stripe\Event\Data;
use webignition\Model\Stripe\Event\Event;
use webignition\Tests\Model\Stripe\AbstractBaseTest;

abstract class AbstractEventTest extends AbstractBaseTest
{
    /**
     * @param array $expectedEventData
     * @param Event $event
     */
    public function assertEventProperties(array $expectedEventData, Event $event)
    {
        $this->assertEquals($expectedEventData['id'], $event->getId());
        $this->assertEquals($expectedEventData['created'], $event->getCreated());
        $this->assertInstanceOf(Data::class, $event->getDataObject());
        $this->assertEquals($expectedEventData['type'], $event->getType());
        $this->assertEquals($expectedEventData['pending_webhooks'], $event->getPendingWebhooks());
        $this->assertEquals($expectedEventData['request_id'], $event->getRequestId());
        $this->assertEquals($expectedEventData['has_request_id'], $event->hasRequestId());
    }
}

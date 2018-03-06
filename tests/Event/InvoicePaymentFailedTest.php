<?php

namespace webignition\Tests\Model\Stripe\Event;

use webignition\Model\Stripe\Event\Data;
use webignition\Model\Stripe\Event\Event;
use webignition\Model\Stripe\Invoice\Invoice;
use webignition\Model\Stripe\Subscription;

class InvoicePaymentFailedTest extends AbstractEventTest
{
    public function testGetEventProperties()
    {
        $event = new Event($this->loadFixture('/Event/invoice.payment_failed.json'));

        $data = $event->getDataObject();
        $this->assertInstanceOf(Data::class, $data);

        /* @var Invoice $invoice */
        $invoice = $data->getObject();
        $this->assertInstanceOf(Invoice::class, $invoice);

        $this->assertFalse($data->hasPreviousAttributes());

        $this->assertTrue($invoice->isForSubscription(new Subscription(json_encode(array(
            'id' => 'su_2c6KOnlvestnGp'
        )))));

        $this->assertEventProperties(
            [
                'id' => 'evt_2nM539jUZHWMN1',
                'created' => '1382372280',
                'type' => 'invoice.payment_failed',
                'pending_webhooks' => 0,
                'request_id' => null,
                'has_request_id' => false,
            ],
            $event
        );
    }
}

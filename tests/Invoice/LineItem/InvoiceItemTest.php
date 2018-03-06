<?php

namespace webignition\Tests\Model\Stripe\Invoice\LineItem;

use webignition\Model\Stripe\Invoice\LineItem\InvoiceItem;

class InvoiceItemTest extends AbstractLineItemTest
{
    public function testGetInvoiceItemProperties()
    {
        $invoiceItem = new InvoiceItem($this->loadFixture('/Invoice/LineItem/invoice-item.json'));

        $this->assertEquals('Foo', $invoiceItem->getDescription());

        $this->assertLineItemProperties(
            [
                'id' => 'ii_3ceeSvsBe2qaNA',
                'amount' => 1000,
                'currency' => 'gbp',
                'is_prorated' => false,
                'type' => 'invoiceitem',
                'period' => [
                    'start' => 1394203949,
                    'end' => 1394203949,
                ],
            ],
            $invoiceItem
        );
    }
}

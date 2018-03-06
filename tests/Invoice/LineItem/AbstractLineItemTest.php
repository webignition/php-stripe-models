<?php

namespace webignition\Tests\Model\Stripe\Invoice\LineItem;

use webignition\Model\Stripe\Invoice\LineItem\LineItem;
use webignition\Model\Stripe\Period;
use webignition\Tests\Model\Stripe\AbstractBaseTest;

abstract class AbstractLineItemTest extends AbstractBaseTest
{
    public function assertLineItemProperties(array $expectedLineItemProperties, LineItem $lineItem)
    {
        $this->assertEquals($expectedLineItemProperties['id'], $lineItem->getId());
        $this->assertEquals($expectedLineItemProperties['amount'], $lineItem->getAmount());
        $this->assertEquals($expectedLineItemProperties['currency'], $lineItem->getCurrency());
        $this->assertEquals($expectedLineItemProperties['is_prorated'], $lineItem->getIsProrated());
        $this->assertEquals($expectedLineItemProperties['type'], $lineItem->getType());
        $this->assertEmpty((array)$lineItem->getMetadata());

        $period = $lineItem->getPeriod();
        $this->assertInstanceOf(Period::class, $period);
        $this->assertEquals($expectedLineItemProperties['period']['start'], $period->getStart());
        $this->assertEquals($expectedLineItemProperties['period']['end'], $period->getEnd());
    }
}

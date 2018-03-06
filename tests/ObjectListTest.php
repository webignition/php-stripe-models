<?php

namespace webignition\Tests\Model\Stripe;

use Doctrine\Common\Collections\ArrayCollection;
use webignition\Model\Stripe\Invoice\LineItem\Subscription as SubscriptionLineItem;
use webignition\Model\Stripe\ObjectList;

class ObjectListTest extends AbstractBaseTest
{
    public function testGetEmptyObjectListProperties()
    {
        /* @var ObjectList $objectList */
        $objectList = new ObjectList($this->loadFixture('/ObjectList/objectlist.empty.json'));

        $this->assertInstanceOf(ObjectList::class, $objectList);

        $this->assertEquals(null, $objectList->getUrl());
        $this->assertEquals(new ArrayCollection(), $objectList->getItems());
        $this->assertEquals(
            [
                'object' => 'list',
            ],
            $objectList->__toArray()
        );
    }

    public function testGetInvoiceLinesObjectListProperties()
    {
        /* @var ObjectList $objectList */
        $objectList = new ObjectList($this->loadFixture('/ObjectList/objectlist.invoicelines.json'));

        $this->assertInstanceOf(ObjectList::class, $objectList);

        $this->assertEquals('/v1/invoices/in_3ceX5TY5UBN4Lr/lines', $objectList->getUrl());

        $items = $objectList->getItems();
        $this->assertInstanceOf(ArrayCollection::class, $items);
        $this->assertFalse($items->isEmpty());
        $this->assertEquals(1, $items->count());

        /* @var SubscriptionLineItem $subscriptionLineItem */
        $subscriptionLineItem = $items->first();
        $this->assertInstanceOf(SubscriptionLineItem::class, $subscriptionLineItem);

        $objectListAsArray = $objectList->__toArray();

        $this->assertArraySubset(
            [
                'object' => 'list',
                'count' => 1,
                'url' => '/v1/invoices/in_3ceX5TY5UBN4Lr/lines',
            ],
            $objectListAsArray
        );

        $objectListAsArrayData = $objectListAsArray['data'];
        $this->assertInternalType('array', $objectListAsArrayData);
        $this->assertCount(1, $objectListAsArrayData);

        $this->assertEquals($objectListAsArrayData[0], $subscriptionLineItem->__toArray());
    }
}

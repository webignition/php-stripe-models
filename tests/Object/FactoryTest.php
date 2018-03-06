<?php

namespace webignition\Tests\Model\Stripe\Object\Factory;

use webignition\Model\Stripe\Card;
use webignition\Model\Stripe\Coupon;
use webignition\Model\Stripe\Customer;
use webignition\Model\Stripe\Discount;
use webignition\Model\Stripe\Event\CustomerSubscriptionUpdated;
use webignition\Model\Stripe\Invoice\Invoice;
use webignition\Model\Stripe\Invoice\LineItem\InvoiceItem;
use webignition\Model\Stripe\Object\Factory;
use webignition\Model\Stripe\ObjectList;
use webignition\Model\Stripe\Period;
use webignition\Model\Stripe\Plan;
use webignition\Model\Stripe\Subscription;
use webignition\Tests\Model\Stripe\AbstractBaseTest;
use webignition\Model\Stripe\Invoice\LineItem\Subscription as LineItemSubscription;

class FactoryTest extends AbstractBaseTest
{
    public function testCreateInvalidJson()
    {
        $this->expectExceptionCode(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid JSON');
        $this->expectExceptionCode(1);

        Factory::create('foo');
    }

    /**
     * @dataProvider createNoModelClassFoundForObjectDataProvider
     *
     * @param array $objectData
     * @param string $expectedExceptionMessage
     */
    public function testCreateNoModelClassFoundForObject(array $objectData, $expectedExceptionMessage)
    {
        $this->expectExceptionCode(\OutOfRangeException::class);
        $this->expectExceptionMessage($expectedExceptionMessage);
        $this->expectExceptionCode(1);

        Factory::create(json_encode($objectData));
    }

    /**
     * @return array
     */
    public function createNoModelClassFoundForObjectDataProvider()
    {
        return [
            'unknown object' => [
                'objectData' => [
                    'object' => 'foo',
                ],
                'expectedExceptionMessage' => 'No model class found for object "foo"',
            ],
            'invalid object' => [
                'objectData' => [
                    'foo' => 'bar',
                ],
                'expectedExceptionMessage' => 'No model class found for object ""',
            ],
        ];
    }

    /**
     * @dataProvider createSuccessDataProvider
     *
     * @param string $fixture
     * @param string $expectedObjectClassName
     */
    public function testCreateSuccess($fixture, $expectedObjectClassName)
    {
        $object = Factory::create($this->loadFixture($fixture));
        $this->assertInstanceOf($expectedObjectClassName, $object);
    }

    /**
     * @return array
     */
    public function createSuccessDataProvider()
    {
        return [
            'card' => [
                'fixture' => '/Card/card.json',
                'expectedObjectClassName' => Card::class,
            ],
            'customer' => [
                'fixture' => '/Customer/customer.no-subscription-no-card.json',
                'expectedObjectClassName' => Customer::class,
            ],
            'plan' => [
                'fixture' => '/Plan/plan.json',
                'expectedObjectClassName' => Plan::class,
            ],
            'subscription' => [
                'fixture' => '/Subscription/subscription.active.json',
                'expectedObjectClassName' => Subscription::class,
            ],
            'list' => [
                'fixture' => '/ObjectList/objectlist.empty.json',
                'expectedObjectClassName' => ObjectList::class,
            ],
            'line item: invoice' => [
                'fixture' => '/Invoice/LineItem/invoice-item.json',
                'expectedObjectClassName' => InvoiceItem::class,
            ],
            'line item: subscription' => [
                'fixture' => '/Invoice/LineItem/subscription-line-item.json',
                'expectedObjectClassName' => LineItemSubscription::class,
            ],
            'invoice' => [
                'fixture' => '/Invoice/with-subscription.json',
                'expectedObjectClassName' => Invoice::class,
            ],
            'period: period_start, period_end' => [
                'fixture' => '/Period/period_start_period_end.json',
                'expectedObjectClassName' => Period::class,
            ],
            'period: start, end' => [
                'fixture' => '/Period/start_end.json',
                'expectedObjectClassName' => Period::class,
            ],
            'coupon' => [
                'fixture' => '/Coupon/coupon.json',
                'expectedObjectClassName' => Coupon::class,
            ],
            'discount' => [
                'fixture' => '/Discount/discount.json',
                'expectedObjectClassName' => Discount::class,
            ],
            'event' => [
                'fixture' => '/Event/customer.subscription.updated.planchange.json',
                'expectedObjectClassName' => CustomerSubscriptionUpdated::class,
            ],
        ];
    }
}

<?php

namespace webignition\Tests\Model\Stripe\Event\Factory;

use webignition\Model\Stripe\Event\Customer\Created;
use webignition\Model\Stripe\Event\Customer\Updated;
use webignition\Model\Stripe\Event\CustomerSubscriptionUpdated;
use webignition\Model\Stripe\Event\Event;
use webignition\Model\Stripe\Event\Factory;
use webignition\Tests\Model\Stripe\AbstractBaseTest;

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
     * @dataProvider createEntityIsNotAnEventDataProvider
     *
     * @param string $json
     */
    public function testCreateEntityIsNotAnEvent($json)
    {
        $this->expectExceptionCode(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Entity is not an event');
        $this->expectExceptionCode(2);

        Factory::create($json);
    }

    /**
     * @return array
     */
    public function createEntityIsNotAnEventDataProvider()
    {
        return [
            'object property missing' => [
                'json' => json_encode([
                    'foo' => 'bar',
                ]),
            ],
            'object event property missing' => [
                'json' => json_encode([
                    'object' => [
                        'foo' => 'bar',
                    ],
                ]),
            ],
        ];
    }

    /**
     * @dataProvider createSuccessDataProvider
     *
     * @param string $fixture
     * @param string $expectedEventClass
     */
    public function testCreateSuccess($fixture, $expectedEventClass)
    {
        $event = Factory::create($this->loadFixture($fixture));

        $this->assertInstanceOf($expectedEventClass, $event);
    }

    /**
     * @return array
     */
    public function createSuccessDataProvider()
    {
        return [
            'customer.created' => [
                'fixture' => '/Event/customer.created.json',
                'expectedEventClass' => Created::class,
            ],
            'customer.subscription.deleted' => [
                'fixture' => '/Event/customer.subscription.deleted.json',
                'expectedEventClass' => Event::class,
            ],
            'customer.subscription.updated' => [
                'fixture' => '/Event/customer.subscription.updated.planchange.json',
                'expectedEventClass' => CustomerSubscriptionUpdated::class,
            ],
            'customer.updated' => [
                'fixture' => '/Event/customer.updated.json',
                'expectedEventClass' => Updated::class,
            ],
            'invoice.payment_failed' => [
                'fixture' => '/Event/invoice.payment_failed.json',
                'expectedEventClass' => Event::class,
            ],
        ];
    }
}

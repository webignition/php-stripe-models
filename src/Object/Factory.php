<?php

namespace webignition\Model\Stripe\Object;

use webignition\Model\Stripe\Card;
use webignition\Model\Stripe\Coupon;
use webignition\Model\Stripe\Customer;
use webignition\Model\Stripe\Discount;
use webignition\Model\Stripe\Event\Factory as EventFactory;
use webignition\Model\Stripe\Invoice\Invoice;
use webignition\Model\Stripe\Invoice\LineItem\InvoiceItem;
use webignition\Model\Stripe\ObjectList;
use webignition\Model\Stripe\Period;
use webignition\Model\Stripe\Plan;
use webignition\Model\Stripe\Subscription;
use webignition\Model\Stripe\Invoice\LineItem\Subscription as LineItemSubscription;

class Factory
{
    /**
     * @var array
     */
    private static $objectTypeToModelClassMap = [
        'card' => Card::class,
        'customer' => Customer::class,
        'plan' => Plan::class,
        'subscription' => Subscription::class,
        'list' => ObjectList::class,
        'line_item' => [
            'subscription' => LineItemSubscription::class,
            'invoiceitem' => InvoiceItem::class,
        ],
        'invoice' => Invoice::class,
        'period' => Period::class,
        'coupon' => Coupon::class,
        'discount' => Discount::class
    ];

    /**
     * @param string $type
     *
     * @return bool
     */
    public static function isKnownEntityType($type)
    {
        return array_key_exists($type, self::$objectTypeToModelClassMap);
    }

    /**
     * @param string $json
     *
     * @return AbstractObject
     *
     * @throws \InvalidArgumentException
     * @throws \OutOfRangeException
     */
    public static function create($json)
    {
        $entity = json_decode($json);

        if (is_null($entity)) {
            throw new \InvalidArgumentException("Invalid JSON", 1);
        }

        $type = null;

        if (self::isObjectEntity($entity)) {
            $type = $entity->object;
        } elseif (self::isPeriodEntity($entity)) {
            $type = 'period';
        }

        if ($type == 'event') {
            return EventFactory::create($json);
        }

        $modelClass = self::isKnownEntityType($type)
            ? self::$objectTypeToModelClassMap[$type]
            : null;

        if (is_null($modelClass)) {
            throw new \OutOfRangeException('No model class found for object "'.$type.'"', 1);
        }

        if ($type == 'line_item') {
            $modelClass = $modelClass[$entity->type];
        }

        return new $modelClass($json);
    }

    /**
     * @param \stdClass $entity
     *
     * @return bool
     */
    private static function isObjectEntity(\stdClass $entity)
    {
        return isset($entity->object);
    }

    /**
     * @param \stdClass $entity
     *
     * @return bool
     */
    private static function isPeriodEntity(\stdClass $entity)
    {
        if (isset($entity->period_start) && isset($entity->period_end)) {
            return true;
        }

        if (isset($entity->start) && isset($entity->end)) {
            return true;
        }

        return false;
    }
}

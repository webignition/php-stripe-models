<?php

namespace webignition\Model\Stripe\Event;

use webignition\Model\Stripe\Event\Customer\Created;
use webignition\Model\Stripe\Event\Customer\Updated;
use webignition\Model\Stripe\Object\AbstractObject;

class Factory
{
    const DEFAULT_EVENT_MODEL_CLASS = Event::class;

    private static $eventTypeToModelClassMap = [
        'customer.subscription.updated' => CustomerSubscriptionUpdated::class,
        'customer.created' => Created::class,
        'customer.updated' => Updated::class,
    ];

    /**
     * @param string $type
     *
     * @return bool
     */
    public static function isKnownEntityType($type)
    {
        return array_key_exists($type, self::$eventTypeToModelClassMap);
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

        if (!isset($entity->object) || $entity->object != 'event') {
            throw new \InvalidArgumentException("Entity is not an event", 2);
        }

        $modelClass = self::getModelClassFromEventType($entity->type);

        return new $modelClass($json);
    }

    /**
     * @param string $type
     *
     * @return string
     */
    private static function getModelClassFromEventType($type)
    {
        return self::isKnownEntityType($type)
            ? self::$eventTypeToModelClassMap[$type]
            : self::DEFAULT_EVENT_MODEL_CLASS;
    }
}

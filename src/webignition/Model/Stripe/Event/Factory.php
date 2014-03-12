<?php

namespace webignition\Model\Stripe\Event;

class Factory {
    
    const DEFAULT_EVENT_MODEL_CLASS = 'webignition\Model\Stripe\Event\Event';
    
    private static $eventTypeToModelClassMap = array(
        'customer.subscription.updated' => 'webignition\Model\Stripe\Event\CustomerSubscriptionUpdated',
    );
    
    
    /**
     * 
     * @param string $type
     * @return boolean
     */
    public static function isKnownEntityType($type) {
        return array_key_exists($type, self::$eventTypeToModelClassMap);
    }
    
    
    /**
     * 
     * @param string $json
     * @return \webignition\Model\Stripe\Object\Object
     * @throws \InvalidArgumentException
     * @throws \OutOfRangeException
     */
    public static function create($json) {                
        $entity = json_decode($json);
        
        if (is_null($entity)) {
            throw new \InvalidArgumentException("Invalid JSON", 1);
        }
        
        if (!isset($entity->object) || $entity->object != 'event') {
            throw new \InvalidArgumentException("Entity is not an event", 2);
        }

        $modelClass = self::getModelClassFromEventType($entity->type);
        
//        var_dump($modelClass);
//        exit();
//
//        if (is_null($modelClass)) {
//            throw new \OutOfRangeException('No model class found for object "'.$type.'"', 1);
//        }
//
//        if ($type == 'line_item') {
//            $modelClass = $modelClass[$entity->type];
//        }
        
        return new $modelClass($json);
    }
    
    
    /**
     * 
     * @param \stdClass $entity
     * @return boolean
     */
    private static function isObjectEntity(\stdClass $entity) {
        return isset($entity->object);
    }
    
    
    /**
     * 
     * @param \stdClass $entity
     * @return boolean
     */
    private static function isPeriodEntity(\stdClass $entity) {
        if (isset($entity->period_start) && isset($entity->period_end)) {
            return true;
        }
        
        if (isset($entity->start) && isset($entity->end)) {
            return true;
        }
        
        return false;
    }
    
    
    /**
     * 
     * @param string $name
     * @return string
     */
    private static function getModelClassFromEventType($name) {
        return (isset(self::$eventTypeToModelClassMap[$name]))
            ? self::$eventTypeToModelClassMap[$name]
            : self::DEFAULT_EVENT_MODEL_CLASS;
    }
}
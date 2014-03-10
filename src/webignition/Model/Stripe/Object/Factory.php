<?php

namespace webignition\Model\Stripe\Object;

class Factory {
    
    private static $objectNameToModelClassMap = array(
        'card' => 'webignition\Model\Stripe\Card',        
        'customer' => 'webignition\Model\Stripe\Customer',
        'plan' => 'webignition\Model\Stripe\Plan',
        'subscription' => 'webignition\Model\Stripe\Subscription',        
        'list' => 'webignition\Model\Stripe\ObjectList',
        'line_item' => array(
            'subscription' => 'webignition\Model\Stripe\Invoice\LineItem\Subscription',
            'invoiceitem' => 'webignition\Model\Stripe\Invoice\LineItem\InvoiceItem'
        ),
        'invoice' => 'webignition\Model\Stripe\Invoice\Invoice',
        'period' => 'webignition\Model\Stripe\Period',
    );
    
    public static function create($json) {        
        $entity = json_decode($json);
        
        if (is_null($entity)) {
            throw new \InvalidArgumentException("Invalid JSON", 1);
        }
        
        if (self::isObjectEntity($entity)) {
            $type = $entity->object;           
        } elseif (self::isPeriodEntity($entity)) {
            $type = 'period';
        }

        $modelClass = self::getModelClassFromObjectName($type);

        if (is_null($modelClass)) {
            throw new \OutOfRangeException('No model class found for object "'.$type.'"', 1);
        }

        if ($type == 'line_item') {
            $modelClass = $modelClass[$entity->type];
        }
        
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
    private static function getModelClassFromObjectName($name) {
        return (isset(self::$objectNameToModelClassMap[$name]))
            ? self::$objectNameToModelClassMap[$name]
            : null;
    }
}
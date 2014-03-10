<?php

namespace webignition\Model\Stripe\Event;

use webignition\Model\Stripe\Object\Factory;
use webignition\Model\Stripe\Object\Object;

class Data extends Object {
    
    public function __construct($json) {        
        parent::__construct($json);        
        $this->setDataProperty('object', Factory::create(json_encode($this->getDataProperty('object'))));
        
        if ($this->hasPreviousAttributes()) {
            $previousAttributes = $this->getPreviousAttributes();
            
            foreach ($previousAttributes as $key => $value) {
                if ($value instanceof \stdClass && isset($value->object) && Factory::isKnownEntityType($value->object)) {
                    $previousAttributes->{$key} = Factory::create(json_encode($value));
                }
            }
            
            $this->setDataProperty('previous_attributes', $previousAttributes);
        }
    }
    
    
    /**
     * 
     * @return \webignition\Model\Stripe\Object\Object
     */
    public function getObject() {
        return $this->getDataProperty('object');
    }
    
    
    /**
     * 
     * @return \stdClass|null
     */
    public function getPreviousAttributes() {
        return $this->getDataProperty('previous_attributes');
    }
    
    
    /**
     * 
     * @return boolean
     */
    public function hasPreviousAttributes() {
        return $this->hasDataProperty('previous_attributes');
    }
    
}
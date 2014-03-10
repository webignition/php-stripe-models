<?php

namespace webignition\Model\Stripe\Event;

use webignition\Model\Stripe\Object\Factory;
use webignition\Model\Stripe\Object\Object;

class Data extends Object {
    
    public function __construct($json) {        
        parent::__construct($json);        
        $this->setDataProperty('object', Factory::create(json_encode($this->getDataProperty('object'))));
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
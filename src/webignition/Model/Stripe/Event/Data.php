<?php

namespace webignition\Model\Stripe\Event;

use Doctrine\Common\Collections\ArrayCollection;
use webignition\Model\Stripe\Object\Factory as ObjectFactory;
use webignition\Model\Stripe\Object\Object;

class Data extends Object {
    
    public function __construct($json) {        
        parent::__construct($json);        
        $this->setDataProperty('object', ObjectFactory::create(json_encode($this->getDataProperty('object'))));
        
        if ($this->hasPreviousAttributes()) {
            $previousAttributesCollection = new ArrayCollection();
            
            foreach ($this->getPreviousAttributes() as $key => $value) {
                if ($value instanceof \stdClass && isset($value->object) && ObjectFactory::isKnownEntityType($value->object)) {
                    $value = ObjectFactory::create(json_encode($value));
                }
                
                $previousAttributesCollection->set($key, $value);
            }
            
            $this->setDataProperty('previous_attributes', $previousAttributesCollection);
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
     * @return \Doctrine\Common\Collections\ArrayCollection|null
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
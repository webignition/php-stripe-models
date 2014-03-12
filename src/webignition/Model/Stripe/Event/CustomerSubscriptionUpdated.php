<?php

namespace webignition\Model\Stripe\Event;

use webignition\Model\Stripe\Event\Event;

class CustomerSubscriptionUpdated extends Event {    
    
    /**
     * 
     * @return boolean
     */
    public function isPlanChange() {
        if (!$this->getDataObject()->hasPreviousAttributes()) {
            return false;
        }
        
        return $this->getDataObject()->getPreviousAttributes()->containsKey('plan');
    }
    
    /**
     * 
     * @return boolean
     */    
    public function isStatusChange() {
        if (!$this->getDataObject()->hasPreviousAttributes()) {
            return false;
        }
        
        return $this->getDataObject()->getPreviousAttributes()->containsKey('status');
    }
    
    /**
     * 
     * @return string|null
     */    
    public function getStatusChange() {
        if (!$this->isStatusChange()) {
            return null;
        }
        
        return $this->getDataObject()->getPreviousAttributes()->get('status') .':'. $this->getDataObject()->getObject()->getStatus();
    }
    
    
    /**
     * 
     * @param string $statusChange
     * @return boolean
     */
    public function hasStatusChange($statusChange) {
        return $this->getStatusChange() == $statusChange;
    }
}
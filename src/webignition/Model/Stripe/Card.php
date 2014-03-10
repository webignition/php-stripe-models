<?php

namespace webignition\Model\Stripe;

use webignition\Model\Stripe\Object\Object;

class Card extends Object { 
    
    /**
     * 
     * @return string
     */
    public function getExpiryMonth() {
        return $this->getDataProperty('exp_month');
    }
    
    
    /**
     * 
     * @return string
     */
    public function getExpiryYear() {
        return $this->getDataProperty('exp_year');
    }
    
    
    /**
     * 
     * @return string
     */
    public function getLast4() {
        return $this->getDataProperty('last4');
    }
    
    
    /**
     * 
     * @return string
     */
    public function getType() {
        return $this->getDataProperty('type');
    }
    
}
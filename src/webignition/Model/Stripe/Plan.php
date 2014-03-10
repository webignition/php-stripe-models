<?php

namespace webignition\Model\Stripe;

use webignition\Model\Stripe\Object\Object;

class Plan extends Object {    
    
    /**
     * 
     * @return string
     */
    public function getName() {
        return $this->getDataProperty('name');
    }
    
    
    /**
     * 
     * @return int
     */
    public function getTrialPeriodDays() {
        return $this->getDataProperty('trial_period_days');
    }
    
    
    /**
     * 
     * @return int
     */
    public function getAmount() {
        return $this->getDataProperty('amount');
    }
    
}
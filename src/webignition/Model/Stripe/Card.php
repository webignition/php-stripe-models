<?php

namespace webignition\Model\Stripe;

use webignition\Model\Stripe\Object\Object;

class Card extends Object { 
    
    const CHECK_KEY_SUFFIX = '_check';
    const CHECK_FAILURE_VALUE = 'fail';
    
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
    
    
    /**
     * 
     * @return array
     */
    public function getCheckFailures() {
        $failures = array();
        
        foreach ($this->getData() as $key => $value) {
            if (preg_match('/'.self::CHECK_KEY_SUFFIX.'$/', $key) && $value == self::CHECK_FAILURE_VALUE) {
                $failures[] = substr($key, 0, strlen($key) - strlen(self::CHECK_KEY_SUFFIX));
            }
        }
        
        return $failures;
    }
    
    
    /**
     * 
     * @return boolean
     */
    public function hasCheckFailures() {
        return count($this->getCheckFailures()) > 0;
    }
    
}
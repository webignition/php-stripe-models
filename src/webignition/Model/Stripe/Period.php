<?php

namespace webignition\Model\Stripe;

use webignition\Model\Stripe\Object\Object;

class Period extends Object {    

    /**
     * 
     * @return int
     */
    public function getStart() {        
        return $this->getPeriodValue('start');
    }    
    
    
    /**
     * 
     * @return int
     */
    public function getEnd() {
        return $this->getPeriodValue('end');     
    }
    
    
    /**
     * 
     * @param string $key
     * @return int|null
     */
    private function getPeriodValue($key) {
        if ($this->hasDataProperty('period_' . $key)) {
            return (int)$this->getDataProperty('period_' . $key);
        }
        
        if ($this->hasDataProperty($key)) {
            return (int)$this->getDataProperty($key);
        }
        
        return null;         
    }
    
}
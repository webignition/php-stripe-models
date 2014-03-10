<?php

namespace webignition\Model\Stripe\Invoice\LineItem;

use webignition\Model\Stripe\Period;

class InvoiceItem extends LineItem {  
    
    
    public function __construct($json) {
        parent::__construct($json);
        
        if ($this->hasDataProperty('period')) {
            $this->setDataProperty('period', new Period(json_encode($this->getDataProperty('period'))));
        }
    }
 
    
    /**
     * 
     * @return string
     */
    public function getDescription() {
        return $this->getDataProperty('description');
    }
    
}
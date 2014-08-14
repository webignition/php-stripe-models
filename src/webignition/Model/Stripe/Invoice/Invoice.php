<?php

namespace webignition\Model\Stripe\Invoice;

use webignition\Model\Stripe\ObjectList;
use webignition\Model\Stripe\Period;
use webignition\Model\Stripe\Object\Object;
use webignition\Model\Stripe\Discount;

class Invoice extends Object {
    
    /**
     *
     * @var \webignition\Model\Stripe\Object\Period 
     */
    private $period;
    
    public function __construct($json) {
        parent::__construct($json);
        
        if ($this->hasDataProperty('lines')) {           
            $this->setDataProperty('lines', new ObjectList(json_encode($this->getDataProperty('lines'))));
        }

        if ($this->hasDataProperty('discount')) {
            $this->setDataProperty('discount', new Discount(json_encode($this->getDataProperty('discount'))));
        }
        
        $this->period = new Period($json);
    }
    
    
    /**
     * 
     * @return int
     */
    public function getDate() {
        return (int)$this->getDataProperty('date');
    }
    
    
    /**
     * 
     * @return string
     */
    public function getId() {
        return $this->getDataProperty('id');
    }
    
    /**
     * 
     * @return \webignition\Model\Stripe\Period 
     */
    public function getPeriod() {
        return $this->period;
    }
    
    
    /**
     * 
     * @return int
     */
    public function getTotal() {
        return $this->getDataProperty('total');
    }
    
    /**
     * 
     * @return int
     */
    public function getSubtotal() {
        return $this->getDataProperty('sub_total');
    } 
    
    
    /**
     * 
     * @return string
     */
    public function getCustomerId() {
        return $this->getDataProperty('customer');
    }
    
    
    /**
     * 
     * @return boolean
     */
    public function getIsAttempted() {
        return $this->getDataProperty('attempted');
    }
    
    /**
     * 
     * @return boolean
     */
    public function getIsClosed() {
        return $this->getDataProperty('closed');
    }
    
    /**
     * 
     * @return boolean
     */
    public function getIsPaid() {
        return $this->getDataProperty('paid');
    }    
    
    
    /**
     * 
     * @return int
     */
    public function getAmountDue() {
        return $this->getDataProperty('amount_due');
    }
    
    
    /**
     * 
     * @return string
     */
    public function getCurrency() {
        return $this->getDataProperty('currency');
    }
    
    
    /**
     * 
     * @return int
     */
    public function getStartingBalance() {
        return (int)$this->getDataProperty('starting_balance');
    }
    
    
    /**
     * 
     * @return int|null
     */
    public function getEndingBalance() {
        $endingBalance = $this->getDataProperty('ending_balance');
        return (is_null($endingBalance)) ? null : (int)$endingBalance;
    }    
    
    /**
     * 
     * @return string|null
     */
    public function getCharge() {
        return $this->getDataProperty('charge');
    }    
    
    
    /**
     * 
     * @return Discount|null
     */
    public function getDiscount() {
        return $this->getDataProperty('discount');
    } 
    
    
    /**
     * 
     * @return int|null
     */    
    public function getApplicationFee() {
        $applicationFee = $this->getDataProperty('application_fee');
        return (is_null($applicationFee)) ? null : (int)$applicationFee;        
    }
    
    
    /**
     * 
     * @return string
     */
    public function getDescription() {
        return $this->getDataProperty('description');
    }
    
    
    /**
     * 
     * @return int
     */
    public function getNextPaymentAttempt() {
        return $this->getDataProperty('next_payment_attempt');
    }
    
    
    /**
     * 
     * @return boolean
     */
    public function hasNextPaymentAttempt() {
        return !is_null($this->getNextPaymentAttempt());
    }
    
    
    /**
     * 
     * @return int
     */
    public function getAttemptCount() {
        return $this->getDataProperty('attempt_count');
    }
    
    
    /**
     * 
     * @return \webignition\Model\Stripe\ObjectList
     */
    public function getLines() {
        return $this->getDataProperty('lines');
    }
    
    
    /**
     * 
     * @return \webignition\Model\Stripe\Invoice\LineItem\Subscription[]
     */
    public function getSubscriptionLines() {
        $lines = array();
        
        foreach ($this->getLines()->getItems() as $item) {
            /* @var $line \webignition\Model\Stripe\Invoice\LineItem\LineItem */
            if ($item->getType() == 'subscription') {
                $lines[] = $item;
            }            
        }
        
        return $lines;
    }
    
    
    /**
     * 
     * @return string
     */
    public function getSubscriptionId() {
        return $this->getDataProperty('subscription');
    }
    
    
    /**
     * 
     * @param \webignition\Model\Stripe\Subscription $subscriptionId
     * @return boolean
     */
    public function isForSubscription(\webignition\Model\Stripe\Subscription $subscription) {
        if ($this->hasDataProperty('subscription')) {
            return $this->getSubscriptionId() == $subscription->getId();
        }
        
        foreach ($this->getSubscriptionLines() as $subscriptionLine) {
            if ($subscriptionLine->getId() == $subscription->getId()) {
                return true;
            }
        }
        
        return false;
    }
    
}
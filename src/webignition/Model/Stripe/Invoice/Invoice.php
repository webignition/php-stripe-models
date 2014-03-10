<?php

namespace webignition\Model\Stripe\Invoice;

use webignition\Model\Stripe\Invoice\LineItem\InvoiceItem;
use webignition\Model\Stripe\Invoice\LineItem\Subscription;
use webignition\Model\Stripe\ObjectList;
use webignition\Model\Stripe\Period;
use webignition\Model\Stripe\Object\Object;

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
     * @return null
     */
    public function getDiscount() {
        // Not yet implemented
        return null;
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
     * @return string
     */
    public function getSubscriptionId() {
        return $this->getDataProperty('subscription');
    }
    
    
    /**
     * 
     * @param string $subscriptionId
     * @return boolean
     */
    public function isForSubscription($subscriptionId) {
        return $this->getSubscriptionId() == $subscriptionId;
    }
    
}
<?php

namespace webignition\Tests\Model\Stripe\Invoice;

use webignition\Tests\Model\Stripe\ObjectTest;

class WithSingleSubscriptionLineItemTest extends ObjectTest { 
    
    public function testGetDate() {
        $this->assertEquals(1394203572, $this->getInvoice()->getDate());
    }
    
    public function testGetId() {
        $this->assertEquals('in_3ceX5TY5UBN4Lr', $this->getInvoice()->getId());
    }    
    
    public function testGetPeriod() {
        $period = $this->getInvoice()->getPeriod();
        
        $this->assertInstanceOf('webignition\Model\Stripe\Period', $period);        
        $this->assertEquals(1394192202, $period->getStart());
        $this->assertEquals(1394203572, $period->getEnd());
    }    
    
    public function testGetLines() {
        $lines = $this->getInvoice()->getLines();
        
        $this->assertInstanceOf('webignition\Model\Stripe\ObjectList', $lines);  
        $this->assertEquals(1, $lines->getItems()->count());
        $this->assertInstanceOf('webignition\Model\Stripe\Invoice\LineItem\Subscription', $lines->getItems()->first());
    }
    
    public function testGetSubscriptionLines() {
        $lines = $this->getInvoice()->getSubscriptionLines();
        
        $this->assertEquals(1, count($lines));
        $this->assertInstanceOf('webignition\Model\Stripe\Invoice\LineItem\Subscription', $lines[0]);
    }
    
    
    public function testGetTotal() {
        $this->assertEquals(0, $this->getInvoice()->getTotal());
    }    
    
    public function testGetSubtotal() {
        $this->assertEquals(0, $this->getInvoice()->getSubtotal());
    }   
    
    public function testGetCustomerId() {
        $this->assertEquals('cus_3cbU7OeaCpcS9D', $this->getInvoice()->getCustomerId());
    }    
    
    public function testGetIsAttempted() {
        $this->assertTrue($this->getInvoice()->getIsAttempted());
    }    
    
    public function testGetClosed() {
        $this->assertTrue($this->getInvoice()->getIsClosed());
    }
    
    public function testGetPaid() {
        $this->assertTrue($this->getInvoice()->getIsPaid());
    } 
    
    public function testGetAttemptCount() {
        $this->assertEquals(0, $this->getInvoice()->getAttemptCount());
    } 
    
    public function testGetAmountDue() {
        $this->assertEquals(0, $this->getInvoice()->getAmountDue());
    } 
    
    public function testGetCurrency() {
        $this->assertEquals('gbp', $this->getInvoice()->getCurrency());
    }    
    
    public function testGetStartingBalance() {
        $this->assertEquals(0, $this->getInvoice()->getStartingBalance());
    }
    
    public function testGetEndingBalance() {
        $this->assertNull($this->getInvoice()->getEndingBalance());
    }    
    
    public function testGetNextPaymentAttempt() {
        $this->assertNull($this->getInvoice()->getNextPaymentAttempt());
    }
    
    public function testGetCharge() {
        $this->assertNull($this->getInvoice()->getCharge());
    }
    
    public function testGetDiscount() {
        $this->assertNull($this->getInvoice()->getDiscount());
    }
    
    public function testGetApplicationFree() {
        $this->assertNull($this->getInvoice()->getApplicationFee());
    }    
    
    public function testGetSubscriptionId() {
        $this->assertEquals('sub_3ceX8jHwVquCNo', $this->getInvoice()->getSubscriptionId());
    } 
    
    public function testGetMetadata() {
        $this->assertEquals(new \stdClass(), $this->getInvoice()->getMetadata());
    }    
 
    public function testGetDescription() {
        $this->assertEquals('', $this->getInvoice()->getDescription());
    }
    
    public function testIsForSubscription() {
        $this->assertTrue($this->getInvoice()->isForSubscription(new \webignition\Model\Stripe\Subscription(json_encode(array(
            'id' => 'sub_3ceX8jHwVquCNo'
        )))));
    }
    
    public function testToArray() {
        $this->assertEquals(array(           
            'date' => 1394203572,
            'id' => 'in_3ceX5TY5UBN4Lr',
            'period_start' => 1394192202,
            'period_end' => 1394203572,
            'lines' => array(
                'object' => 'list',
                'count' => 1,
                'url' => '/v1/invoices/in_3ceX5TY5UBN4Lr/lines',
                'data' => array(
                    array(
                        'id' => 'sub_3ceX8jHwVquCNo',
                        'object' => 'line_item',
                        'type' => 'subscription',
                        'livemode' => false,
                        'amount' => 0,
                        'currency' => 'gbp',
                        'proration' => false,
                        'period' => array(
                            'start' => 1394203572,
                            'end' => 1396795572    
                        ),
                        'quantity' => 1,
                        'plan' => array(
                            'interval' => 'month',
                            'name' => 'Personal',
                            'created' => 1370600314,
                            'amount' => 900,
                            'currency' => 'gbp',
                            'id' => 'personal-9',
                            'object' => 'plan',
                            'livemode' => false,
                            'interval_count' => 1,
                            'trial_period_days' => 30,
                            'metadata' => array()    
                        ),
                        'description' => null,
                        'metadata' => array(),            
                    )
                )    
            ),
            'subtotal' => 0,
            'total' => 0,
            'customer' => 'cus_3cbU7OeaCpcS9D',
            'object' => 'invoice',
            'attempted' => true,
            'closed' => true,
            'paid' => true,
            'livemode' => false,
            'attempt_count' => 0,
            'amount_due' => 0,
            'currency' => 'gbp',
            'starting_balance' => 0,
            'ending_balance' => null,
            'next_payment_attempt' => null,
            'charge' => null,
            'discount' => null,
            'application_fee' => null,
            'subscription' => 'sub_3ceX8jHwVquCNo',
            'metadata' => array(),
            'description' => null,
            
        ), $this->getInvoice()->__toArray());
    }    
    
    
    /**
     * 
     * @return \webignition\Model\Stripe\Invoice\Invoice
     */
    private function getInvoice() {
        return $this->object;
    }
    
}
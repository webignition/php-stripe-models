<?php

namespace webignition\Tests\Model\Stripe\Object\Factory;

use webignition\Model\Stripe\Object\Factory;
use webignition\Tests\Model\Stripe\BaseTest;

class CreateTest extends BaseTest {
    
    public function testCard() {        
        $this->assertInstanceOf('webignition\Model\Stripe\Card', Factory::create($this->getFixture('Card/card.json')));
    }
    
    public function testPlan() {        
        $this->assertInstanceOf('webignition\Model\Stripe\Plan', Factory::create($this->getFixture('Plan/plan.json')));
    }      
    
    public function testSubscription() {        
        $this->assertInstanceOf('webignition\Model\Stripe\Subscription', Factory::create($this->getFixture('Subscription/subscription.json')));
    }      
    
    public function testCustomerNoSubscriptionNoCard() {        
        $customer = Factory::create($this->getFixture('Customer/no-subscription-no-card.json'));        
        
        $this->assertInstanceOf('webignition\Model\Stripe\Customer', $customer);
        $this->assertFalse($customer->hasCard());
    }    
    
    public function testCustomerWithSubscriptionNoCard() {        
        $customer = Factory::create($this->getFixture('Customer/with-subscription-no-card.json'));        
        
        $this->assertInstanceOf('webignition\Model\Stripe\Customer', $customer);
        $this->assertTrue($customer->hasSubscription());
        $this->assertFalse($customer->hasCard());
    }     
    
    public function testCustomerWithSubscriptionWithCard() {        
        $customer = Factory::create($this->getFixture('Customer/with-subscription-with-card.json'));        
        
        $this->assertInstanceOf('webignition\Model\Stripe\Customer', $customer);
        $this->assertTrue($customer->hasSubscription());
        $this->assertTrue($customer->hasCard());        
    }
    
    public function testEmptySubscriptionsList() {
        $list = Factory::create($this->getFixture('List/subscriptions-empty.json'));        
        
        $this->assertInstanceOf('webignition\Model\Stripe\ObjectList', $list);
        $this->assertEquals(0, $list->getItems()->count());
    }
    
    public function testSubscriptionsList() {
        $list = Factory::create($this->getFixture('List/subscriptions.json'));        
        
        $this->assertInstanceOf('webignition\Model\Stripe\ObjectList', $list);
        $this->assertEquals(1, $list->getItems()->count());
        
        foreach ($list->getItems() as $item) {
            $this->assertInstanceOf('webignition\Model\Stripe\Subscription', $item);
        }
    }    
    
    public function testEmptyCardsList() {
        $list = Factory::create($this->getFixture('List/cards-empty.json'));        
        
        $this->assertInstanceOf('webignition\Model\Stripe\ObjectList', $list);
        $this->assertEquals(0, $list->getItems()->count());
    }
    
    public function testCardsList() {
        $list = Factory::create($this->getFixture('List/cards.json'));        
        
        $this->assertInstanceOf('webignition\Model\Stripe\ObjectList', $list);
        $this->assertEquals(1, $list->getItems()->count());
        
        foreach ($list->getItems() as $item) {
            $this->assertInstanceOf('webignition\Model\Stripe\Card', $item);
        }
    }
    
    public function testInvoiceSubscriptionLineItem() {
        $this->assertInstanceOf('webignition\Model\Stripe\Invoice\LineItem\Subscription', Factory::create($this->getFixture('Invoice/subscription-line-item.json')));
    }
    
    public function testInvoiceInvoiceItemLineItem() {
        $this->assertInstanceOf('webignition\Model\Stripe\Invoice\LineItem\InvoiceItem', Factory::create($this->getFixture('Invoice/invoice-item-line-item.json')));
    }
    
    public function testInvoice() {        
        $this->assertInstanceOf('webignition\Model\Stripe\Invoice\Invoice', Factory::create($this->getFixture('Invoice/invoice.json')));
    }    
    
    public function testPeriodAsPeriodStartPeriodEnd() {        
        $this->assertInstanceOf('webignition\Model\Stripe\Period', Factory::create($this->getFixture('Period/as-period-start-period-end.json')));
    }     
    
    public function testPeriodAsStartEnd() {        
        $this->assertInstanceOf('webignition\Model\Stripe\Period', Factory::create($this->getFixture('Period/as-start-end.json')));
    }
    
    public function testEvent() {
        $this->assertInstanceOf('webignition\Model\Stripe\Event\Event', Factory::create($this->getFixture('Event/customer.subscription.deleted.json')));
    }

    public function testCoupon() {
        $this->assertInstanceOf('webignition\Model\Stripe\Coupon', Factory::create($this->getFixture('Coupon/coupon.json')));
    }

}
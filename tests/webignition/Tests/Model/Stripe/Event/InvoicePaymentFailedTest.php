<?php

namespace webignition\Tests\Model\Stripe\Event;

use webignition\Model\Stripe\Subscription;

class InvoicePaymentFailedTest extends EventTest { 

    public function testIsForSubscription() {
        $this->assertTrue($this->getEvent()->getDataObject()->getObject()->isForSubscription(new Subscription(json_encode(array(
            'id' => 'su_2c6KOnlvestnGp'
        )))));
       
    }

    
}
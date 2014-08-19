<?php

namespace webignition\Tests\Model\Stripe\Event;

class CustomerCreatedTest extends EventTest {

    public function testGetCustomer() {
        $this->assertInstanceOf('webignition\Model\Stripe\Customer', $this->getEvent()->getCustomer());
    }

    
}
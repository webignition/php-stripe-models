<?php

namespace webignition\Tests\Model\Stripe\Event;

class CustomerSubscriptionUpdatedTest extends EventTest { 

    public function testGetPreviousAttributePlanAsObject() {
        $this->assertInstanceOf('webignition\Model\Stripe\Plan', $this->getEvent()->getDataObject()->getPreviousAttributes()->plan);
    }

    
}
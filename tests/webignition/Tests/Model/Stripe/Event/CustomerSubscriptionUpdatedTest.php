<?php

namespace webignition\Tests\Model\Stripe\Event;

class CustomerSubscriptionUpdatedTest extends EventTest { 

    public function testGetPreviousAttributePlanAsObject() {
        $this->assertTrue($this->getEvent()->getDataObject()->getPreviousAttributes()->containsKey('plan'));
        $this->assertInstanceOf('webignition\Model\Stripe\Plan', $this->getEvent()->getDataObject()->getPreviousAttributes()->get('plan'));
    }

    
}
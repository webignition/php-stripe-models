<?php

namespace webignition\Tests\Model\Stripe\Event;

use webignition\Tests\Model\Stripe\ObjectTest;

abstract class EventTest extends ObjectTest { 
    
    /**
     * 
     * @return \webignition\Model\Stripe\Event\Event
     */
    protected function getEvent() {
        return $this->object;
    }
    
}
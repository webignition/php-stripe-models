<?php

namespace webignition\Tests\Model\Stripe\Card;

use webignition\Tests\Model\Stripe\ObjectTest;

abstract class CardTest extends ObjectTest { 
    
    /**
     * 
     * @return \webignition\Model\Stripe\Card
     */
    protected function getCard() {
        return $this->object;
    }
    
}
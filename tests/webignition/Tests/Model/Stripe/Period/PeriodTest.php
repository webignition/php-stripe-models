<?php

namespace webignition\Tests\Model\Stripe\Period;

use webignition\Tests\Model\Stripe\ObjectTest;

abstract class PeriodTest extends ObjectTest { 
    
    public function testGetStart() {        
        $this->assertEquals(1394203572, $this->getPeriod()->getStart());
    }    
    
    public function testGetEnd() {        
        $this->assertEquals(1396795572, $this->getPeriod()->getEnd());
    } 
    
    
    /**
     * 
     * @return \webignition\Model\Stripe\Period
     */
    protected function getPeriod() {
        return $this->object;
    }
    
}
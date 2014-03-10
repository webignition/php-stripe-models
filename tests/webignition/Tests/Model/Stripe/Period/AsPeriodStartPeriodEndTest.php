<?php

namespace webignition\Tests\Model\Stripe\Period;

class AsPeriodStartPeriodEndTest extends PeriodTest { 
    
    public function testToArray() {
        $this->assertEquals(array(
            'period_start' => 1394203572,
            'period_end' => 1396795572,
           
        ), $this->getPeriod()->__toArray());
    }
    
}
<?php

namespace webignition\Tests\Model\Stripe\Period;

class AsStartEndTest extends PeriodTest { 
    
    public function testToArray() {
        $this->assertEquals(array(
            'start' => 1394203572,
            'end' => 1396795572
        ), $this->getPeriod()->__toArray());
    }
    
}
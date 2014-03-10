<?php

namespace webignition\Tests\Model\Stripe\Plan;

use webignition\Tests\Model\Stripe\ObjectTest;

class PlanTest extends ObjectTest { 
    
    public function testGetName() {        
        $this->assertEquals('Agency', $this->getPlan()->getName());
    }    
    
    public function testGetTrialPeriodDays() {
        $this->assertEquals('30', $this->getPlan()->getTrialPeriodDays());
    }
    
    public function testGetAmount() {
        $this->assertEquals('900', $this->getPlan()->getAmount());
    }
    
    public function testToArray() {
        $this->assertEquals(array(
            'interval' => 'month',
            'name' => 'Agency',
            'created' => 1371118751,
            'amount' => 900,
            'currency' => 'gbp',
            'id' => 'agency-9',
            'object' => 'plan',
            'livemode' => false,
            'interval_count' => 1,
            'trial_period_days' => 30,
            'metadata' => array(),            
        ), $this->getPlan()->__toArray());
    }    
    
    
    /**
     * 
     * @return \webignition\Model\Stripe\Plan
     */
    private function getPlan() {
        return $this->object;
    }
    
}
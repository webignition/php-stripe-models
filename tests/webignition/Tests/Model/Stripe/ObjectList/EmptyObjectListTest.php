<?php

namespace webignition\Tests\Model\Stripe\ObjectList;

use webignition\Tests\Model\Stripe\ObjectTest;

class EmptyObjectListTest extends ObjectTest { 
    
    public function testGetItems() {
        $this->assertEquals(0, $this->getObjectList()->getItems()->count());
    }
    
    public function testGetUrl() {        
        $this->assertEquals('', $this->getObjectList()->getUrl());
    }
    
    public function testToArray() {        
        $this->assertEquals(array(
            'object' => 'list'
        ), $this->getObjectList()->__toArray());
    }    
    
    
    /**
     * 
     * @return \webignition\Model\Stripe\ObjectList
     */
    private function getObjectList() {
        return $this->object;
    }
    
}
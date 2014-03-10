<?php

namespace webignition\Tests\Model\Stripe\Card;

use webignition\Tests\Model\Stripe\ObjectTest;

class CardTest extends ObjectTest { 
    
    public function testGetExpiryMonth() {
        $this->assertEquals('1', $this->getCard()->getExpiryMonth());
    }    
    
    public function testGetExpiryYear() {
        $this->assertEquals('2024', $this->getCard()->getExpiryYear());
    }
    
    public function testGetLast4() {
        $this->assertEquals('4242', $this->getCard()->getLast4());
    }
    
    public function testGetType() {
        $this->assertEquals('Visa', $this->getCard()->getType());
    }
    
    public function testToArray() {
        $this->assertEquals(array(
            'id' => 'card_3ZEbOIFfsVo22H',
            'object' => 'card',
            'last4' => '4242',
            'type' => 'Visa',
            'exp_month' => 1,
            'exp_year' => 2024,
            'fingerprint' => '7y5WDQllCuyzj32D',
            'customer' => 'cus_3cbU7OeaCpcS9D',
            'country' => 'US',
            'name' => 'Mr Foo Bar',
            'address_line1' => 'Address Line 1',
            'address_line2' => null,
            'address_city' => 'Address City',
            'address_state' => 'Address State',
            'address_zip' => 'Address Zip',
            'address_country' => 'GB',
            'cvc_check' => 'pass',
            'address_line1_check' => 'pass',
            'address_zip_check' => 'pass',         
        ), $this->getCard()->__toArray());
    }    
    
    
    /**
     * 
     * @return \webignition\Model\Stripe\Card
     */
    private function getCard() {
        return $this->object;
    }
    
}
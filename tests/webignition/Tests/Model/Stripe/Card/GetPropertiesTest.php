<?php

namespace webignition\Tests\Model\Stripe\Card;

class GetPropertiesTest extends CardTest { 
    
    public function testGetId() {
        $this->assertEquals('card_3ZEbOIFfsVo22H', $this->getCard()->getId());
    }    
    
    public function testGetLast4() {
        $this->assertEquals('4242', $this->getCard()->getLast4());
    }    
    
    public function testGetType() {
        $this->assertEquals('Visa', $this->getCard()->getType());
    }    
    
    public function testGetExpiryMonth() {
        $this->assertEquals('1', $this->getCard()->getExpiryMonth());
    }    
    
    public function testGetExpiryYear() {
        $this->assertEquals('2024', $this->getCard()->getExpiryYear());
    }
    
    public function testGetFingerprint() {
        $this->assertEquals('7y5WDQllCuyzj32D', $this->getCard()->getFingerprint());
    }    
    
    public function testGetCustomerId() {
        $this->assertEquals('cus_3cbU7OeaCpcS9D', $this->getCard()->getCustomerId());
    } 
    
/*    
  "cvc_check": "pass",
  "address_line1_check": "pass",
  "address_zip_check": "pass"
 * 
    public function testGetFoo() {
        $this->assertEquals('', $this->getCard()->getFoo());
    }
*/    
    
    public function testGetCountry() {
        $this->assertEquals('US', $this->getCard()->getCountry());
    }
    
    public function testGetName() {
        $this->assertEquals('Mr Foo Bar', $this->getCard()->getName());
    }
    
    public function testGetAddressLine1() {
        $this->assertEquals('Address Line 1', $this->getCard()->getAddressLine1());
    }
    
    public function testGetAddressLine2() {
        $this->assertEquals('Address Line 2', $this->getCard()->getAddressLine2());
    }

    public function testGetAddressCity() {
        $this->assertEquals('Address City', $this->getCard()->getAddressCity());
    }
    
    public function testGetAddressState() {
        $this->assertEquals('Address State', $this->getCard()->getAddressState());
    }
    
    public function testGetAddressZip() {
        $this->assertEquals('Address Zip', $this->getCard()->getAddressZip());
    }
    
    public function testGetAddressCountry() {
        $this->assertEquals('GB', $this->getCard()->getAddressCountry());
    }
    
    public function testIsPassedCvcCheck() {
        $this->assertTrue($this->getCard()->isPassedCvcCheck());
    }    
    
    public function testIsPassedAddressLine1Check() {
        $this->assertTrue($this->getCard()->isPassedAddressLine1Check());
    }
    
    public function testIsPassedAddressZipCheck() {
        $this->assertTrue($this->getCard()->isPassedAddressZipCheck());
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
            'address_line2' => 'Address Line 2',
            'address_city' => 'Address City',
            'address_state' => 'Address State',
            'address_zip' => 'Address Zip',
            'address_country' => 'GB',
            'cvc_check' => 'pass',
            'address_line1_check' => 'pass',
            'address_zip_check' => 'pass',         
        ), $this->getCard()->__toArray());
    }
    
}
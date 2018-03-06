<?php

namespace webignition\Tests\Model\Stripe;

use webignition\Model\Stripe\Card;

class CardTest extends AbstractBaseTest
{
    /**
     * @dataProvider getCardPropertiesDataProvider
     *
     * @param string $fixture
     * @param array $expectedCardData
     */
    public function testGetCardProperties($fixture, array $expectedCardData)
    {
        $card = new Card($this->loadFixture($fixture));

        $this->assertEquals($expectedCardData['id'], $card->getId());
        $this->assertEquals($expectedCardData['last4'], $card->getLast4());
        $this->assertEquals($expectedCardData['type'], $card->getType());
        $this->assertEquals($expectedCardData['expiry_month'], $card->getExpiryMonth());
        $this->assertEquals($expectedCardData['expiry_year'], $card->getExpiryYear());
        $this->assertEquals($expectedCardData['fingerprint'], $card->getFingerprint());
        $this->assertEquals($expectedCardData['customer_id'], $card->getCustomerId());
        $this->assertEquals($expectedCardData['country'], $card->getCountry());
        $this->assertEquals($expectedCardData['name'], $card->getName());
        $this->assertEquals($expectedCardData['address_line1'], $card->getAddressLine1());
        $this->assertEquals($expectedCardData['address_line2'], $card->getAddressLine2());
        $this->assertEquals($expectedCardData['address_city'], $card->getAddressCity());
        $this->assertEquals($expectedCardData['address_state'], $card->getAddressState());
        $this->assertEquals($expectedCardData['address_zip'], $card->getAddressZip());
        $this->assertEquals($expectedCardData['address_country'], $card->getAddressCountry());
        $this->assertEquals($expectedCardData['is_passed_cvc_check'], $card->isPassedCvcCheck());
        $this->assertEquals($expectedCardData['is_passed_address_line1_check'], $card->isPassedAddressLine1Check());
        $this->assertEquals($expectedCardData['is_passed_address_zip_check'], $card->isPassedAddressZipCheck());
        $this->assertEquals($expectedCardData['check_failures'], $card->getCheckFailures());
        $this->assertEquals($expectedCardData['has_check_failures'], $card->hasCheckFailures());
    }

    /**
     * @return array
     */
    public function getCardPropertiesDataProvider()
    {
        return [
            'no failures' => [
                'fixture' => '/Card/card.json',
                'expectedCardData' => [
                    'id' => 'card_3ZEbOIFfsVo22H',
                    'last4' => '4242',
                    'type' => 'Visa',
                    'expiry_month' => 1,
                    'expiry_year' => 2024,
                    'fingerprint' => '7y5WDQllCuyzj32D',
                    'customer_id' => 'cus_3cbU7OeaCpcS9D',
                    'country' => 'US',
                    'name' => 'Mr Foo Bar',
                    'address_line1' => 'Address Line 1',
                    'address_line2' => 'Address Line 2',
                    'address_city' => 'Address City',
                    'address_state' => 'Address State',
                    'address_zip' => 'Address Zip',
                    'address_country' => 'GB',
                    'is_passed_cvc_check' => true,
                    'is_passed_address_line1_check' =>  true,
                    'is_passed_address_zip_check' =>  true,
                    'check_failures' => [],
                    'has_check_failures' => false,
                ],
            ],
            'address line1 fail' => [
                'fixture' => '/Card/card.address_line1_fail.json',
                'expectedCardData' => [
                    'id' => 'card_3ZEbOIFfsVo22H',
                    'last4' => '4242',
                    'type' => 'Visa',
                    'expiry_month' => 1,
                    'expiry_year' => 2024,
                    'fingerprint' => '7y5WDQllCuyzj32D',
                    'customer_id' => 'cus_3cbU7OeaCpcS9D',
                    'country' => 'US',
                    'name' => 'Mr Foo Bar',
                    'address_line1' => 'Address Line 1',
                    'address_line2' => null,
                    'address_city' => 'Address City',
                    'address_state' => 'Address State',
                    'address_zip' => 'Address Zip',
                    'address_country' => 'GB',
                    'is_passed_cvc_check' => true,
                    'is_passed_address_line1_check' =>  false,
                    'is_passed_address_zip_check' =>  true,
                    'check_failures' => [
                        'address_line1',
                    ],
                    'has_check_failures' => true,
                ],
            ],
            'address zip fail' => [
                'fixture' => '/Card/card.address_zip_fail.json',
                'expectedCardData' => [
                    'id' => 'card_3ZEbOIFfsVo22H',
                    'last4' => '4242',
                    'type' => 'Visa',
                    'expiry_month' => 1,
                    'expiry_year' => 2024,
                    'fingerprint' => '7y5WDQllCuyzj32D',
                    'customer_id' => 'cus_3cbU7OeaCpcS9D',
                    'country' => 'US',
                    'name' => 'Mr Foo Bar',
                    'address_line1' => 'Address Line 1',
                    'address_line2' => null,
                    'address_city' => 'Address City',
                    'address_state' => 'Address State',
                    'address_zip' => 'Address Zip',
                    'address_country' => 'GB',
                    'is_passed_cvc_check' => true,
                    'is_passed_address_line1_check' =>  true,
                    'is_passed_address_zip_check' =>  false,
                    'check_failures' => [
                        'address_zip',
                    ],
                    'has_check_failures' => true,
                ],
            ],
            'cvc fail' => [
                'fixture' => '/Card/card.cvc_fail.json',
                'expectedCardData' => [
                    'id' => 'card_3ZEbOIFfsVo22H',
                    'last4' => '4242',
                    'type' => 'Visa',
                    'expiry_month' => 1,
                    'expiry_year' => 2024,
                    'fingerprint' => '7y5WDQllCuyzj32D',
                    'customer_id' => 'cus_3cbU7OeaCpcS9D',
                    'country' => 'US',
                    'name' => 'Mr Foo Bar',
                    'address_line1' => 'Address Line 1',
                    'address_line2' => null,
                    'address_city' => 'Address City',
                    'address_state' => 'Address State',
                    'address_zip' => 'Address Zip',
                    'address_country' => 'GB',
                    'is_passed_cvc_check' => false,
                    'is_passed_address_line1_check' =>  true,
                    'is_passed_address_zip_check' =>  true,
                    'check_failures' => [
                        'cvc',
                    ],
                    'has_check_failures' => true,
                ],
            ],
        ];
    }
}

<?php

namespace webignition\Tests\Model\Stripe\Invoice;

use webignition\Model\Stripe\Discount;
use webignition\Model\Stripe\Invoice\Invoice;
use webignition\Model\Stripe\Invoice\LineItem\Subscription as LineItemSubscription;
use webignition\Model\Stripe\ObjectList;
use webignition\Model\Stripe\Period;
use webignition\Model\Stripe\Subscription;
use webignition\Tests\Model\Stripe\AbstractBaseTest;

class InvoiceTest extends AbstractBaseTest
{
    /**
     * @dataProvider getInvoicePropertiesDataProvider
     *
     * @param string $fixture
     * @param array $expectedInvoiceData
     */
    public function testGetInvoiceProperties($fixture, array $expectedInvoiceData)
    {
        /* @var Invoice $invoice */
        $invoice = new Invoice($this->loadFixture($fixture));

        $this->assertEquals($expectedInvoiceData['date'], $invoice->getDate());
        $this->assertEquals($expectedInvoiceData['id'], $invoice->getId());
        $this->assertEquals($expectedInvoiceData['total'], $invoice->getTotal());
        $this->assertEquals($expectedInvoiceData['sub_total'], $invoice->getSubtotal());
        $this->assertEquals($expectedInvoiceData['customer_id'], $invoice->getCustomerId());
        $this->assertEquals($expectedInvoiceData['is_attempted'], $invoice->getIsAttempted());
        $this->assertEquals($expectedInvoiceData['is_closed'], $invoice->getIsClosed());
        $this->assertEquals($expectedInvoiceData['is_paid'], $invoice->getIsPaid());
        $this->assertEquals($expectedInvoiceData['attempt_count'], $invoice->getAttemptCount());
        $this->assertEquals($expectedInvoiceData['amount_due'], $invoice->getAmountDue());
        $this->assertEquals($expectedInvoiceData['currency'], $invoice->getCurrency());
        $this->assertEquals($expectedInvoiceData['starting_balance'], $invoice->getStartingBalance());
        $this->assertEquals($expectedInvoiceData['ending_balance'], $invoice->getEndingBalance());
        $this->assertEquals($expectedInvoiceData['next_payment_attempt'], $invoice->getNextPaymentAttempt());
        $this->assertEquals($expectedInvoiceData['charge'], $invoice->getCharge());
        $this->assertEquals($expectedInvoiceData['application_fee'], $invoice->getApplicationFee());
        $this->assertEquals($expectedInvoiceData['subscription_id'], $invoice->getSubscriptionId());
        $this->assertEquals($expectedInvoiceData['description'], $invoice->getDescription());
        $this->assertEquals($expectedInvoiceData['has_next_payment_attempt'], $invoice->hasNextPaymentAttempt());

        $period = $invoice->getPeriod();
        $this->assertInstanceOf(Period::class, $period);
        $this->assertEquals($expectedInvoiceData['period']['start'], $period->getStart());
        $this->assertEquals($expectedInvoiceData['period']['end'], $period->getEnd());

        $invoiceLines = $invoice->getLines();
        $this->assertInstanceOf(ObjectList::class, $invoiceLines);
        $this->assertEquals(count($expectedInvoiceData['lines']), $invoiceLines->getItems()->count());
        $this->assertInstanceOf(LineItemSubscription::class, $invoiceLines->getItems()->first());

        $subscriptionLines = $invoice->getSubscriptionLines();
        $this->assertEquals(1, count($subscriptionLines));
        $this->assertInstanceOf(LineItemSubscription::class, $subscriptionLines[0]);

        $this->assertTrue($invoice->isForSubscription($expectedInvoiceData['is_for_subscription']));

        $this->assertEquals($expectedInvoiceData['has_discount'], $invoice->hasDiscount());

        if ($expectedInvoiceData['has_discount']) {
            $this->assertInstanceOf(Discount::class, $invoice->getDiscount());
        } else {
            $this->assertNull($invoice->getDiscount());
        }
    }

    /**
     * @return array
     */
    public function getInvoicePropertiesDataProvider()
    {
        return [
            'single subscription line item, no discount' => [
                'fixture' => '/Invoice/with-subscription.json',
                'expectedInvoiceData' => [
                    'date' => 1394203572,
                    'id' => 'in_3ceX5TY5UBN4Lr',
                    'total' => 10,
                    'sub_total' => 9,
                    'customer_id' => 'cus_3cbU7OeaCpcS9D',
                    'is_attempted' => true,
                    'is_closed' => true,
                    'is_paid' => true,
                    'attempt_count' => 0,
                    'amount_due' => 0,
                    'currency' => 'gbp',
                    'starting_balance' => 0,
                    'ending_balance' => null,
                    'next_payment_attempt' => null,
                    'charge' => null,
                    'application_fee' => null,
                    'subscription_id' => 'sub_3ceX8jHwVquCNo',
                    'description' => '',
                    'period' => [
                        'start' => 1394192202,
                        'end' => 1394203572,
                    ],
                    'lines' => [
                        [],
                    ],
                    'is_for_subscription' => new Subscription(json_encode([
                        'id' => 'sub_3ceX8jHwVquCNo',
                    ])),
                    'has_discount' => false,
                    'has_next_payment_attempt' => false,
                ],
            ],
            'single subscription line item, has discount' => [
                'fixture' => '/Invoice/with-subscription-with-discount.json',
                'expectedInvoiceData' => [
                    'date' => 1408031278,
                    'id' => 'in_4abfD1nt0ael6N',
                    'total' => 720,
                    'sub_total' => 900,
                    'customer_id' => 'cus_4aACyO4kB8UDrm',
                    'is_attempted' => true,
                    'is_closed' => true,
                    'is_paid' => true,
                    'attempt_count' => 1,
                    'amount_due' => 720,
                    'currency' => 'gbp',
                    'starting_balance' => 0,
                    'ending_balance' => 0,
                    'next_payment_attempt' => null,
                    'charge' => 'ch_4abgnj73etU4jU',
                    'application_fee' => null,
                    'subscription_id' => 'sub_4aAC7YTVV9P8VL',
                    'description' => '',
                    'period' => [
                        'start' => 1407929095,
                        'end' => 1408031226,
                    ],
                    'lines' => [
                        [],
                    ],
                    'is_for_subscription' => new Subscription(json_encode([
                        'id' => 'sub_4aAC7YTVV9P8VL',
                    ])),
                    'has_discount' => true,
                    'has_next_payment_attempt' => false,
                ],
            ],
        ];
    }

    /**
     * @dataProvider isForSubscriptionDataProvider
     *
     * @param Invoice $invoice
     * @param Subscription $subscription
     * @param bool$expectedIs
     */
    public function testIsForSubscription(Invoice $invoice, Subscription $subscription, $expectedIs)
    {
        $this->assertEquals($expectedIs, $invoice->isForSubscription($subscription));
    }

    /**
     * @return array
     */
    public function isForSubscriptionDataProvider()
    {
        return [
            'invoice has matching subscription id property' => [
                'invoice' => new Invoice(json_encode([
                    'object' => 'invoice',
                    'subscription' => 'sub_4aAC7YTVV9P8VL',
                ])),
                'subscription' => new Subscription(json_encode([
                    'object' => 'subscription',
                    'id' => 'sub_4aAC7YTVV9P8VL',
                ])),
                'expectedIs' => true,
            ],
            'invoice not has matching subscription id property' => [
                'invoice' => new Invoice(json_encode([
                    'object' => 'invoice',
                    'subscription' => 'sub_4aAC7YTVV9P8VL',
                ])),
                'subscription' => new Subscription(json_encode([
                    'object' => 'subscription',
                ])),
                'expectedIs' => false,
            ],
            'invoice has matching subscription line' => [
                'invoice' => new Invoice(json_encode([
                    'object' => 'invoice',
                    'lines' => [
                        'object' => 'list',
                        'data' => [
                            [
                                'object' => 'line_item',
                                'type' => 'subscription',
                                'id' => 'sub_3ceX8jHwVquCNo',
                            ],
                        ],
                    ],
                ])),
                'subscription' => new Subscription(json_encode([
                    'object' => 'subscription',
                    'id' => 'sub_3ceX8jHwVquCNo',
                ])),
                'expectedIs' => true,
            ],
            'invoice not has matching subscription line' => [
                'invoice' => new Invoice(json_encode([
                    'object' => 'invoice',
                    'lines' => [
                        'object' => 'list',
                        'data' => [
                            [
                                'object' => 'line_item',
                                'type' => 'subscription',
                                'id' => 'sub_3ceX8jHwVquCNo',
                            ],
                        ],
                    ],
                ])),
                'subscription' => new Subscription(json_encode([
                    'object' => 'subscription',
                    'id' => 'sub_3deX8jHwVquCNo',
                ])),
                'expectedIs' => false,
            ],
        ];
    }
}

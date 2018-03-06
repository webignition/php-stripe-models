<?php

namespace webignition\Tests\Model\Stripe;

use webignition\Model\Stripe\Period;

class PeriodTest extends AbstractBaseTest
{
    /**
     * @dataProvider getPeriodPropertiesDataProvider
     *
     * @param array $periodData
     * @param array $expectedPeriodProperties
     */
    public function testGetPeriodProperties(array $periodData, array $expectedPeriodProperties)
    {
        $period = new Period(json_encode($periodData));

        $this->assertEquals($expectedPeriodProperties['start'], $period->getStart());
        $this->assertEquals($expectedPeriodProperties['end'], $period->getEnd());
    }

    /**
     * @return array
     */
    public function getPeriodPropertiesDataProvider()
    {
        return [
            'has period_start has period_end' => [
                'periodData' => [
                    'period_start' => 1,
                    'period_end' => 2,
                ],
                'expectedPeriodProperties' => [
                    'start' => 1,
                    'end' => 2,
                ],
            ],
            'has period_start not has period_end' => [
                'periodData' => [
                    'period_start' => 3,
                ],
                'expectedPeriodProperties' => [
                    'start' => 3,
                    'end' => null,
                ],
            ],
            'not has period_start has period_end' => [
                'periodData' => [
                    'period_end' => 4,
                ],
                'expectedPeriodProperties' => [
                    'start' => null,
                    'end' => 4,
                ],
            ],
            'has start has end' => [
                'periodData' => [
                    'start' => 5,
                    'end' => 6,
                ],
                'expectedPeriodProperties' => [
                    'start' => 5,
                    'end' => 6,
                ],
            ],
            'not has start has end' => [
                'periodData' => [
                    'end' => 7,
                ],
                'expectedPeriodProperties' => [
                    'start' => null,
                    'end' => 7,
                ],
            ],
            'has start not has end' => [
                'periodData' => [
                    'start' => 8,
                ],
                'expectedPeriodProperties' => [
                    'start' => 8,
                    'end' => null,
                ],
            ],
        ];
    }
}

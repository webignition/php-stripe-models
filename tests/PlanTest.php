<?php

namespace webignition\Tests\Model\Stripe;

use webignition\Model\Stripe\Plan;

class PlanTest extends AbstractBaseTest
{
    /**
     * @dataProvider getPlanPropertiesDataProvider
     *
     * @param array $planData
     */
    public function testGetPlanProperties(array $planData)
    {
        $plan = new Plan($this->loadFixture('/Plan/plan.json'));

        $this->assertEquals($planData['name'], $plan->getName());
        $this->assertEquals($planData['trial_period_days'], $plan->getTrialPeriodDays());
        $this->assertEquals($planData['amount'], $plan->getAmount());
        $this->assertEquals($planData['interval'], $plan->getInterval());
        $this->assertEquals($planData['currency'], $plan->getCurrency());
    }

    /**
     * @return array
     */
    public function getPlanPropertiesDataProvider()
    {
        return [
            'default' => [
                'planData' => [
                    'object' => 'plan',
                    'name' => 'Agency',
                    'trial_period_days' => 30,
                    'amount' => 900,
                    'interval' => 'month',
                    'currency' => 'gbp',
                ],
            ],
        ];
    }
}

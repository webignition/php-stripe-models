<?php

namespace webignition\Tests\Model\Stripe;

use webignition\Model\Stripe\Object\Factory;
use webignition\Tests\Model\Stripe\BaseTest;

abstract class ObjectTest extends BaseTest {
    
    /**
     *
     * @var \webignition\Model\Stripe\Object
     */
    protected $object;    
    
    public function setUp() {
        $this->setTestFixturePath(get_class($this));
        $this->object = Factory::create($this->getFixture('object.json'));
    }
    
}
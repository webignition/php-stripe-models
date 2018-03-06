<?php

namespace webignition\Tests\Model\Stripe;

abstract class AbstractBaseTest extends \PHPUnit_Framework_TestCase
{
    const FIXTURES_BASE_PATH = '/fixtures';

    /**
     * @param string $fixture
     *
     * @return string
     */
    protected function loadFixture($fixture)
    {
        return file_get_contents(realpath(__DIR__ . self::FIXTURES_BASE_PATH . $fixture));
    }
}

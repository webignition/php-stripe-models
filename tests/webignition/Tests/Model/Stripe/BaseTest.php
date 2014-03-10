<?php

namespace webignition\Tests\Model\Stripe;

abstract class BaseTest extends \PHPUnit_Framework_TestCase {  
    
    const FIXTURES_BASE_PATH = '/../../../../fixtures';
    
    /**
     *
     * @var string
     */
    private $fixturePath = null;
    

    
    public function setUp() {        
        $this->setTestFixturePath(get_class($this));
    }
   

    
    /**
     * 
     * @param string $testClass
     * @param string $testMethod
     */
    protected function setTestFixturePath($testClass, $testMethod = null) {
        $this->fixturePath = __DIR__ . self::FIXTURES_BASE_PATH . '/' . str_replace('\\', '/', $testClass);
        
        if (is_string($testMethod)) {
            $this->fixturePath .=  '/' . $testMethod;
        }
    }    
    
    
    /**
     * 
     * @return string
     */
    protected function getTestFixturePath() {
        return $this->fixturePath;     
    }
    
    
    /**
     * 
     * @param string $fixtureName
     * @return string
     */
    protected function getFixture($fixtureName) {        
        if (file_exists($this->getTestFixturePath() . '/' . $fixtureName)) {
            return file_get_contents($this->getTestFixturePath() . '/' . $fixtureName);
        }
        
        return file_get_contents(__DIR__ . self::FIXTURES_BASE_PATH . '/Common/' . $fixtureName);        
    }
    

   
    
}
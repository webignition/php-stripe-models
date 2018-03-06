<?php

namespace webignition\Model\Stripe;

use webignition\Model\Stripe\Object\AbstractObject;

class Card extends AbstractObject
{
    const CHECK_KEY_SUFFIX = '_check';
    const CHECK_FAILURE_VALUE = 'fail';

    /**
     * @return string
     */
    public function getId()
    {
        return $this->getDataProperty('id');
    }

    /**
     * @return string
     */
    public function getLast4()
    {
        return $this->getDataProperty('last4');
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->getDataProperty('type');
    }

    /**
     * @return string
     */
    public function getExpiryMonth()
    {
        return $this->getDataProperty('exp_month');
    }

    /**
     * @return string
     */
    public function getExpiryYear()
    {
        return $this->getDataProperty('exp_year');
    }

    /**
     * @return string
     */
    public function getFingerprint()
    {
        return $this->getDataProperty('fingerprint');
    }

    /**
     * @return string
     */
    public function getCustomerId()
    {
        return $this->getDataProperty('customer');
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->getDataProperty('country');
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getDataProperty('name');
    }

    /**
     * @return string
     */
    public function getAddressLine1()
    {
        return $this->getDataProperty('address_line1');
    }

    /**
     * @return string
     */
    public function getAddressLine2()
    {
        return $this->getDataProperty('address_line2');
    }

    /**
     * @return string
     */
    public function getAddressCity()
    {
        return $this->getDataProperty('address_city');
    }

    /**
     * @return string
     */
    public function getAddressState()
    {
        return $this->getDataProperty('address_state');
    }

    /**
     * @return string
     */
    public function getAddressZip()
    {
        return $this->getDataProperty('address_zip');
    }

    /**
     * @return string
     */
    public function getAddressCountry()
    {
        return $this->getDataProperty('address_country');
    }

    /**
     * @return bool
     */
    public function isPassedCvcCheck()
    {
        return !in_array('cvc', $this->getCheckFailures());
    }

    /**
     * @return bool
     */
    public function isPassedAddressLine1Check()
    {
        return !in_array('address_line1', $this->getCheckFailures());
    }

    /**
     * @return bool
     */
    public function isPassedAddressZipCheck()
    {
        return !in_array('address_zip', $this->getCheckFailures());
    }

    /**
     * @return array
     */
    public function getCheckFailures()
    {
        $failures = [];

        foreach ($this->getData() as $key => $value) {
            if (preg_match('/'.self::CHECK_KEY_SUFFIX.'$/', $key) && $value == self::CHECK_FAILURE_VALUE) {
                $failures[] = substr($key, 0, strlen($key) - strlen(self::CHECK_KEY_SUFFIX));
            }
        }

        return $failures;
    }

    /**
     * @return bool
     */
    public function hasCheckFailures()
    {
        return count($this->getCheckFailures()) > 0;
    }
}

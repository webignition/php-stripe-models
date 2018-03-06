<?php

namespace webignition\Model\Stripe\Object;

abstract class AbstractObject
{
    /**
     * @var \stdClass
     */
    private $data;

    /**
     * @param string $json
     */
    public function __construct($json)
    {
        $this->data = json_decode($json);

        if (!is_null($this->data) && property_exists($this->data, 'metadata')) {
            $this->setDataProperty('metadata', new \stdClass());
        }
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    protected function getDataProperty($name)
    {
        if (!$this->hasDataProperty($name)) {
            return null;
        }

        return $this->data->{$name};
    }

    /**
     * @param string $name
     *
     * @param mixed $value
     */
    protected function setDataProperty($name, $value)
    {
        $this->data->{$name} = $value;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    protected function hasDataProperty($name)
    {
        return isset($this->data->{$name});
    }

    /**
     * @return \stdClass
     */
    protected function getData()
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getMetadata()
    {
        return $this->getDataProperty('metadata');
    }

    /**
     * @return array
     */
    public function __toArray()
    {
        $returnArray = (array)$this->getData();

        if (isset($returnArray['metadata'])) {
            $returnArray['metadata'] = (array)$returnArray['metadata'];
        }

        foreach ($returnArray as $key => $value) {
            if ($value instanceof AbstractObject) {
                $returnArray[$key] = $value->__toArray();
            }
        }

        return $returnArray;
    }
}

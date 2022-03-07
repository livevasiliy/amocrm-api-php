<?php

namespace AmoCRM\EntitiesServices;

use AmoCRM\Exceptions\InvalidArgumentException;

/**
 * Class BaseEntityTypeEntity
 *
 * @package AmoCRM\EntitiesServices
 */
abstract class BaseEntityTypeEntity extends BaseEntity
{
    protected $entityType = '';

    /**
     * @param string $entityType
     *
     * @return string
     * @throws InvalidArgumentException
     */
    abstract protected function validateEntityType($entityType);

    /**
     * @param string $entityType
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setEntityType($entityType)
    {
        $entityType = $this->validateEntityType($entityType);
        $this->entityType = $entityType;

        return $this;
    }

    /**
     * @return string
     */
    public function getEntityType()
    {
        return $this->entityType;
    }

    /**
     * @return string
     */
    protected function getMethod()
    {
        $method = parent::getMethod();

        return sprintf($method, $this->getEntityType());
    }
}

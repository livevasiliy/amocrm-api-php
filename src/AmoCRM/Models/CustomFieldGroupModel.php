<?php

namespace AmoCRM\Models;

use AmoCRM\Models\Traits\RequestIdTrait;
use InvalidArgumentException;

class CustomFieldGroupModel extends BaseApiModel
{
    use RequestIdTrait;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var bool
     */
    protected $isPredefined;

    /**
     * @var int
     */
    protected $sort;

    /**
     * @var string|null
     */
    protected $entityType;

    /**
     * @var array
     */
    protected $fields;

    /**
     * @param array $customFieldGroup
     *
     * @return self
     */
    public static function fromArray(array $customFieldGroup)
    {
        if (empty($customFieldGroup['id'])) {
            throw new InvalidArgumentException('Custom field group id is empty in ' . json_encode($customFieldGroup));
        }

        $customFieldGroupModel = new self();

        $customFieldGroupModel
            ->setId($customFieldGroup['id'])
            ->setName($customFieldGroup['name'])
            ->setSort($customFieldGroup['sort'])
            ->setIsPredefined($customFieldGroup['is_predefined'])
            ->setEntityType($customFieldGroup['entity_type'])
            ->setFields($customFieldGroup['fields']);

        return $customFieldGroupModel;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'sort' => $this->getSort(),
            'is_predefined' => $this->getIsPredefined(),
            'entity_type' => $this->getEntityType(),
            'fields' => $this->getFields(),
        ];
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return CustomFieldGroupModel
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return CustomFieldGroupModel
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @param int $sort
     * @return CustomFieldGroupModel
     */
    public function setSort($sort)
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * @return bool
     */
    public function getIsPredefined()
    {
        return $this->isPredefined;
    }

    /**
     * @param bool $flag
     * @return CustomFieldGroupModel
     */
    public function setIsPredefined($flag)
    {
        $this->isPredefined = $flag;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEntityType()
    {
        return $this->entityType;
    }

    /**
     * @param string|null $entityType
     *
     * @return CustomFieldGroupModel
     */
    public function setEntityType($entityType)
    {
        $this->entityType = $entityType;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param array|null $fields
     * @return $this
     */
    public function setFields($fields)
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * @param string|null $requestId
     * @return array
     */
    public function toApi($requestId = null)
    {
        $result = [];

        if (!is_null($this->getId())) {
            $result['id'] = $this->getId();
        }

        if (!is_null($this->getName())) {
            $result['name'] = $this->getName();
        }

        if (!is_null($this->getSort())) {
            $result['sort'] = $this->getSort();
        }

        if (is_null($this->getRequestId()) && !is_null($requestId)) {
            $this->setRequestId($requestId);
        }

        if (null !== $this->getFields()) {
            $result['fields'] = $this->getFields();
        }

        $result['request_id'] = $this->getRequestId();

        return $result;
    }
}

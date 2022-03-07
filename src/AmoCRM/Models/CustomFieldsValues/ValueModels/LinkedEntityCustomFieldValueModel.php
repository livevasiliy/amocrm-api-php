<?php

namespace AmoCRM\Models\CustomFieldsValues\ValueModels;

/**
 * Class LinkedEntityCustomFieldValueModel
 *
 * @package AmoCRM\Models\CustomFieldsValues\ValueModels
 */
class LinkedEntityCustomFieldValueModel extends BaseArrayCustomFieldValueModel
{
    const NAME = 'name';
    const ENTITY_ID = 'entity_id';
    const ENTITY_TYPE = 'entity_type';
    const CATALOG_ID = 'catalog_id';

    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var int|null
     */
    protected $entityId;

    /**
     * @var string|null
     */
    protected $entityType;

    /**
     * @var int|null
     */
    protected $catalogId;

    /**
     * @param array|null $value
     *
     * @return LinkedEntityCustomFieldValueModel
     */
    public static function fromArray($value)
    {
        $model = new static();

        $model
            ->setName(isset($value['value'][self::NAME]) ? $value['value'][self::NAME] : null)
            ->setEntityId(isset($value['value'][self::ENTITY_ID]) ? $value['value'][self::ENTITY_ID] : null)
            ->setEntityType(isset($value['value'][self::ENTITY_TYPE]) ? $value['value'][self::ENTITY_TYPE] : null)
            ->setCatalogId(isset($value['value'][self::CATALOG_ID]) ? $value['value'][self::CATALOG_ID] : null);

        return $model;
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     *
     * @return LinkedEntityCustomFieldValueModel
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getEntityId()
    {
        return $this->entityId;
    }

    /**
     * @param int|null $entityId
     *
     * @return LinkedEntityCustomFieldValueModel
     */
    public function setEntityId($entityId)
    {
        $this->entityId = $entityId;

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
     * @return LinkedEntityCustomFieldValueModel
     */
    public function setEntityType($entityType)
    {
        $this->entityType = $entityType;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCatalogId()
    {
        return $this->catalogId;
    }

    /**
     * @param int|null $catalogId
     *
     * @return LinkedEntityCustomFieldValueModel
     */
    public function setCatalogId($catalogId)
    {
        $this->catalogId = $catalogId;

        return $this;
    }


    public function toArray()
    {
        return [
            self::NAME => $this->getName(),
            self::ENTITY_ID => $this->getEntityId(),
            self::ENTITY_TYPE => $this->getEntityType(),
            self::CATALOG_ID => $this->getCatalogId(),
        ];
    }

    /**
     * @return array
     */
    public function getValue()
    {
        return $this->toArray();
    }


    public function toApi($requestId = null)
    {
        return [
            'value' => $this->getValue(),
        ];
    }
}

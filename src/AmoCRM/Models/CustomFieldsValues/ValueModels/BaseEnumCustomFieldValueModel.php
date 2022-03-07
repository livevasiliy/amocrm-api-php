<?php

namespace AmoCRM\Models\CustomFieldsValues\ValueModels;

/**
 * Class BaseEnumCustomFieldValueModel
 *
 * @package AmoCRM\Models\CustomFieldsValues\ValueModels
 */
class BaseEnumCustomFieldValueModel extends BaseCustomFieldValueModel
{
    /**
     * @var int|null
     */
    protected $enumId;

    /**
     * @param array $value
     *
     * @return BaseCustomFieldValueModel
     */
    public static function fromArray($value)
    {
        $model = new static();

        $enumId = isset($value['enum_id']) ? (int)$value['enum_id'] : null;
        $fieldValue = isset($value['value']) ? $value['value'] : null;

        $model
            ->setValue($fieldValue)
            ->setEnumId($enumId);

        return $model;
    }

    /**
     * @return int|null
     */
    public function getEnumId()
    {
        return $this->enumId;
    }

    /**
     * @param null|int $enumId
     *
     * @return BaseEnumCustomFieldValueModel
     */
    public function setEnumId($enumId)
    {
        $this->enumId = $enumId;

        return $this;
    }

    public function toArray()
    {
        return [
            'value' => $this->getValue(),
            'enum_id' => $this->getEnumId(),
        ];
    }

    public function toApi($requestId = null)
    {
        return [
            'value' => $this->getValue(),
            'enum_id' => $this->getEnumId(),
        ];
    }
}

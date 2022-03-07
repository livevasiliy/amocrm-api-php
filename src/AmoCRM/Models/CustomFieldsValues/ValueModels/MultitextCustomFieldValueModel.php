<?php

namespace AmoCRM\Models\CustomFieldsValues\ValueModels;

/**
 * Class MultitextCustomFieldValueModel
 *
 * @package AmoCRM\Models\CustomFieldsValues\ValueModels
 */
class MultitextCustomFieldValueModel extends BaseEnumCustomFieldValueModel
{
    /**
     * @var string
     */
    protected $enum;

    /**
     * @return null|string
     */
    public function getEnum()
    {
        return $this->enum;
    }

    /**
     * @param null|string $enum
     *
     * @return MultitextCustomFieldValueModel
     */
    public function setEnum($enum)
    {
        $this->enum = $enum;

        return $this;
    }

    /**
     * @param array $value
     *
     * @return MultitextCustomFieldValueModel
     */
    public static function fromArray($value)
    {
        $model = new static();

        $enumId = isset($value['enum_id']) ? (int)$value['enum_id'] : null;
        $enum = isset($value['enum_code']) ? (string)$value['enum_code'] : null;
        $fieldValue = isset($value['value']) ? $value['value'] : null;

        $model
            ->setValue($fieldValue)
            ->setEnumId($enumId)
            ->setEnum($enum);

        return $model;
    }

    public function toApi($requestId = null)
    {
        return [
            'value' => $this->getValue(),
            'enum_id' => $this->getEnumId(),
            'enum_code' => $this->getEnum(),
        ];
    }

    public function toArray()
    {
        return [
            'value' => $this->getValue(),
            'enum_id' => $this->getEnumId(),
            'enum_code' => $this->getEnum(),
        ];
    }
}

<?php

namespace AmoCRM\Models\CustomFieldsValues\ValueModels;

/**
 * Class BaseEnumCodeCustomFieldValueModel
 *
 * @package AmoCRM\Models\CustomFieldsValues\ValueModels
 */
class BaseEnumCodeCustomFieldValueModel extends BaseCustomFieldValueModel
{
    /**
     * @var string|null
     */
    protected $enumCode;

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
        $enumCode = isset($value['enum_code']) ? $value['enum_code'] : null;
        $fieldValue = isset($value['value']) ? $value['value'] : null;

        $model
            ->setValue($fieldValue)
            ->setEnumId($enumId)
            ->setEnumCode($enumCode);

        return $model;
    }

    /**
     * @return string|null
     */
    public function getEnumCode()
    {
        return $this->enumCode;
    }

    /**
     * @param string|null $enumCode
     *
     * @return BaseEnumCodeCustomFieldValueModel
     */
    public function setEnumCode($enumCode)
    {
        $this->enumCode = $enumCode;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getEnumId()
    {
        return $this->enumId;
    }

    /**
     * @param int|null $enumId
     *
     * @return BaseEnumCodeCustomFieldValueModel
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
            'enum_code' => $this->getEnumCode(),
        ];
    }

    public function toApi($requestId = null)
    {
        return [
            'value' => $this->getValue(),
            'enum_id' => $this->getEnumId(),
            'enum_code' => $this->getEnumCode(),
        ];
    }
}

<?php

namespace AmoCRM\Models\CustomFieldsValues;

use AmoCRM\Exceptions\BadTypeException;
use AmoCRM\Models\BaseApiModel;
use AmoCRM\Models\CustomFieldsValues\Factories\CustomFieldValuesModelFactory;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\BaseCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueModels\BaseCustomFieldValueModel;

/**
 * Class BaseCustomFieldValuesModel
 *
 * @package AmoCRM\Models\CustomFieldsValues
 */
class BaseCustomFieldValuesModel extends BaseApiModel
{
    /**
     * @var int|null
     */
    protected $fieldId;

    /**
     * @var string|null
     */
    protected $fieldCode;

    /**
     * @var string|null
     */
    protected $fieldName;

    /**
     * @var BaseCustomFieldValueCollection
     */
    protected $values;

    /**
     * @param array $value
     *
     * @return BaseCustomFieldValuesModel
     * @throws BadTypeException
     */
    public static function fromArray(array $value)
    {
        return CustomFieldValuesModelFactory::createModel($value);
    }

    /**
     * @return int|null
     */
    public function getFieldId()
    {
        return $this->fieldId;
    }

    /**
     * @param int|null $fieldId
     *
     * @return BaseCustomFieldValuesModel
     */
    public function setFieldId($fieldId)
    {
        $this->fieldId = $fieldId;

        return $this;
    }

    /**
     * @return string
     */
    public function getFieldType()
    {
        return '';
    }

    /**
     * @return string|null
     */
    public function getFieldCode()
    {
        return $this->fieldCode;
    }

    /**
     * @param string|null $fieldCode
     *
     * @return BaseCustomFieldValuesModel
     */
    public function setFieldCode($fieldCode)
    {
        $this->fieldCode = $fieldCode;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFieldName()
    {
        return $this->fieldName;
    }

    /**
     * @return BaseCustomFieldValueCollection
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param BaseCustomFieldValueCollection $values
     *
     * @return BaseCustomFieldValuesModel
     */
    public function setValues(BaseCustomFieldValueCollection $values)
    {
        $this->values = $values;

        return $this;
    }

    /**
     * @param string|null $fieldName
     *
     * @return BaseCustomFieldValuesModel
     */
    public function setFieldName($fieldName)
    {
        $this->fieldName = $fieldName;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'field_id' => $this->getFieldId(),
            'field_code' => $this->getFieldCode(),
            'field_name' => $this->getFieldName(),
            'field_type' => $this->getFieldType(),
            'values' => $this->getValues()->toArray(),
        ];
    }

    /**
     * @param string $requestId
     *
     * @return array
     */
    public function toApi($requestId = null)
    {
        $values = $this->getValues();
        return [
            'field_id' => $this->getFieldId(),
            'field_code' => $this->getFieldCode(),
            'values' => $values ? $values->toApi() : null,
        ];
    }
}

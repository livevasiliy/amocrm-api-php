<?php

namespace AmoCRM\Models\CustomFieldsValues\ValueModels;

use AmoCRM\Models\BaseApiModel;

/**
 * Class BaseCustomFieldValueModel
 *
 * @package AmoCRM\Models\CustomFieldsValues\ValueModels
 */
class BaseCustomFieldValueModel extends BaseApiModel
{
    /**
     * @var int|string|null|array|bool|object
     */
    protected $value;

    /**
     * @param int|string|null $value
     *
     * @return BaseCustomFieldValueModel
     */
    public static function fromArray($value)
    {
        $model = new static();

        $model
            ->setValue(isset($value['value']) ? $value['value'] : null);

        return $model;
    }

    /**
     * @return int|string|null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param int|string|null|array|bool $value
     *
     * @return BaseCustomFieldValueModel
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    public function toArray()
    {
        return [
            'value' => $this->getValue(),
        ];
    }

    public function toApi($requestId = null)
    {
        return [
            'value' => $this->getValue(),
        ];
    }
}

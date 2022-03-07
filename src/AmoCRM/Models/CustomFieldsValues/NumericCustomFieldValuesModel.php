<?php

namespace AmoCRM\Models\CustomFieldsValues;

use AmoCRM\Helpers\CustomFieldHelper;

/**
 * Class NumericCustomFieldValuesModel
 *
 * @package AmoCRM\Models\CustomFieldsValues
 */
class NumericCustomFieldValuesModel extends BaseCustomFieldValuesModel
{
    /**
     * @return string
     */
    public function getFieldType()
    {
        return CustomFieldHelper::FIELD_TYPE_CODE_NUMERIC;
    }
}

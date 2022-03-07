<?php

namespace AmoCRM\Models\CustomFieldsValues;

use AmoCRM\Helpers\CustomFieldHelper;

/**
 * Class DateCustomFieldValuesModel
 *
 * @package AmoCRM\Models\CustomFieldsValues
 */
class DateCustomFieldValuesModel extends BaseCustomFieldValuesModel
{
    /**
     * @return string
     */
    public function getFieldType()
    {
        return CustomFieldHelper::FIELD_TYPE_CODE_DATE;
    }
}

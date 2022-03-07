<?php

namespace AmoCRM\Models\CustomFieldsValues;

use AmoCRM\Models\CustomFields\CustomFieldModel;

/**
 * Class CategoryCustomFieldValuesModel
 *
 * @package AmoCRM\Models\CustomFieldsValues
 */
class CategoryCustomFieldValuesModel extends BaseCustomFieldValuesModel
{
    /**
     * @return string
     */
    public function getFieldType()
    {
        return CustomFieldModel::TYPE_CATEGORY;
    }
}

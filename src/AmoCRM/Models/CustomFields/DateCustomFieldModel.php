<?php

namespace AmoCRM\Models\CustomFields;

/**
 * Class DateCustomFieldModel
 *
 * @package AmoCRM\Models\CustomFields
 */
class DateCustomFieldModel extends CustomFieldModel
{
    /**
     * @return string
     */
    public function getType()
    {
        return CustomFieldModel::TYPE_DATE;
    }
}

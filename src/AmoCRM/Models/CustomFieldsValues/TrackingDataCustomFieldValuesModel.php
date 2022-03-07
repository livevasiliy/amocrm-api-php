<?php

namespace AmoCRM\Models\CustomFieldsValues;

use AmoCRM\Models\CustomFields\CustomFieldModel;

/**
 * Class TrackingDataCustomFieldValuesModel
 *
 * @package AmoCRM\Models\CustomFieldsValues
 */
class TrackingDataCustomFieldValuesModel extends BaseCustomFieldValuesModel
{
    /**
     * @return string
     */
    public function getFieldType()
    {
        return CustomFieldModel::TYPE_TRACKING_DATA;
    }
}

<?php

namespace AmoCRM\Models\CustomFields;

/**
 * Class TrackingDataCustomFieldModel
 *
 * @package AmoCRM\Models\CustomFields
 */
class TrackingDataCustomFieldModel extends CustomFieldModel
{
    /**
     * @return string
     */
    public function getType()
    {
        return CustomFieldModel::TYPE_TRACKING_DATA;
    }
}

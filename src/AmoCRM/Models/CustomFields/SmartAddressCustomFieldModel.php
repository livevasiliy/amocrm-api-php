<?php

namespace AmoCRM\Models\CustomFields;

/**
 * Class SmartAddressCustomFieldModel
 *
 * @package AmoCRM\Models\CustomFields
 */
class SmartAddressCustomFieldModel extends WithEnumCustomFieldModel
{
    /**
     * @return string
     */
    public function getType()
    {
        return CustomFieldModel::TYPE_SMART_ADDRESS;
    }
}

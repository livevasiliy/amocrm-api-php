<?php

namespace AmoCRM\Models\CustomFields;

/**
 * Class ItemsCustomFieldModel
 *
 * @package AmoCRM\Models\CustomFields
 */
class ItemsCustomFieldModel extends CustomFieldModel
{
    /**
     * @return string
     */
    public function getType()
    {
        return CustomFieldModel::TYPE_ITEMS;
    }
}

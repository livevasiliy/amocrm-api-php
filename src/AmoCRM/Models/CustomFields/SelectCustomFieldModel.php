<?php

namespace AmoCRM\Models\CustomFields;

/**
 * Class SelectCustomFieldModel
 *
 * @package AmoCRM\Models\CustomFields
 */
class SelectCustomFieldModel extends WithEnumCustomFieldModel
{
    /**
     * @return string
     */
    public function getType()
    {
        return CustomFieldModel::TYPE_SELECT;
    }
}

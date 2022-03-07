<?php

namespace AmoCRM\Models\CustomFields;

/**
 * Class MultiselectCustomFieldModel
 *
 * @package AmoCRM\Models\CustomFields
 */
class MultiselectCustomFieldModel extends WithEnumCustomFieldModel
{
    /**
     * @return string
     */
    public function getType()
    {
        return CustomFieldModel::TYPE_MULTISELECT;
    }
}

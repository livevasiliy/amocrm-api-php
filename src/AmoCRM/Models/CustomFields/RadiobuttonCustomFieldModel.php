<?php

namespace AmoCRM\Models\CustomFields;

/**
 * Class RadiobuttonCustomFieldModel
 *
 * @package AmoCRM\Models\CustomFields
 */
class RadiobuttonCustomFieldModel extends WithEnumCustomFieldModel
{
    /**
     * @return string
     */
    public function getType()
    {
        return CustomFieldModel::TYPE_RADIOBUTTON;
    }
}

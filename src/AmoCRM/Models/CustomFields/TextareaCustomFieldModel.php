<?php

namespace AmoCRM\Models\CustomFields;

/**
 * Class TextareaCustomFieldModel
 *
 * @package AmoCRM\Models\CustomFields
 */
class TextareaCustomFieldModel extends CustomFieldModel
{
    /**
     * @return string
     */
    public function getType()
    {
        return CustomFieldModel::TYPE_TEXTAREA;
    }
}

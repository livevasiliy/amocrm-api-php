<?php

namespace AmoCRM\Models\CustomFields;

/**
 * Class UrlCustomFieldModel
 *
 * @package AmoCRM\Models\CustomFields
 */
class UrlCustomFieldModel extends CustomFieldModel
{
    /**
     * @return string
     */
    public function getType()
    {
        return CustomFieldModel::TYPE_URL;
    }
}

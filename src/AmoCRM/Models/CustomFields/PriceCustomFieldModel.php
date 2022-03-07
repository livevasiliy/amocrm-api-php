<?php

namespace AmoCRM\Models\CustomFields;

/**
 * Class PriceCustomFieldModel
 *
 * @package AmoCRM\Models\CustomFields
 */
class PriceCustomFieldModel extends CustomFieldModel
{
    /**
     * @return string
     */
    public function getType()
    {
        return CustomFieldModel::TYPE_PRICE;
    }
}

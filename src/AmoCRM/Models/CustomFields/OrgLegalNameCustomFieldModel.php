<?php

namespace AmoCRM\Models\CustomFields;

/**
 * @deprecated
 */
class OrgLegalNameCustomFieldModel extends CustomFieldModel
{
    /**
     * @return string
     */
    public function getType()
    {
        return CustomFieldModel::TYPE_ORG_LEGAL_NAME;
    }
}

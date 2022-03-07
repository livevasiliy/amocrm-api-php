<?php

namespace AmoCRM\Models\CustomFields;

/**
 * Class BirthdayCustomFieldModel
 *
 * @package AmoCRM\Models\CustomFields
 */
class BirthdayCustomFieldModel extends CustomFieldModel
{
    const REMIND_NEVER = 'never';
    const REMIND_DAY = 'day';
    const REMIND_WEEK = 'week';
    const REMIND_MONTH = 'month';

    /**
     * @var string|null
     */
    protected $remind;

    /**
     * @return string
     */
    public function getType()
    {
        return CustomFieldModel::TYPE_BIRTHDAY;
    }

    /**
     * @return null|string
     */
    public function getRemind()
    {
        return $this->remind;
    }

    /**
     * @param string $remind
     *
     * @return BirthdayCustomFieldModel
     */
    public function setRemind($remind)
    {
        if (
            !in_array(
                $remind,
                [
                    self::REMIND_NEVER,
                    self::REMIND_DAY,
                    self::REMIND_MONTH,
                    self::REMIND_WEEK,
                ]
            )
        ) {
            $remind = self::REMIND_NEVER;
        }

        $this->remind = $remind;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $result = parent::toArray();

        $result['remind'] = $this->getRemind();

        return $result;
    }

    /**
     * @param string|null $requestId
     *
     * @return array
     */
    public function toApi($requestId = "0")
    {
        $result = parent::toApi($requestId);

        $result['remind'] = $this->getRemind();

        return $result;
    }

    /**
     * @param array $customField
     *
     * @return CustomFieldModel|BirthdayCustomFieldModel
     */
    public static function fromArray(array $customField)
    {
        /** @var BirthdayCustomFieldModel $result */
        $result = parent::fromArray($customField);

        if (!empty($customField['remind'])) {
            $result->setRemind($customField['remind']);
        }

        return $result;
    }
}

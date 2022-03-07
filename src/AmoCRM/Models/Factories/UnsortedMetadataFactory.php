<?php

namespace AmoCRM\Models\Factories;

use AmoCRM\Exceptions\BadTypeException;
use AmoCRM\Models\Unsorted\Interfaces\UnsortedMetadataInterface;
use AmoCRM\Models\Unsorted\BaseUnsortedModel;
use AmoCRM\Models\Unsorted\ChatsMetadata;
use AmoCRM\Models\Unsorted\FormsMetadata;
use AmoCRM\Models\Unsorted\MailMetadata;
use AmoCRM\Models\Unsorted\SipMetadata;

/**
 * Class UnsortedMetadataFactory
 *
 * @package AmoCRM\Models\Factories
 */
class UnsortedMetadataFactory
{
    /**
     * @param string $category
     * @param array $metadata
     *
     * @return UnsortedMetadataInterface
     * @throws BadTypeException
     */
    public static function createForCategory($category, array $metadata)
    {
        switch ($category) {
            case BaseUnsortedModel::CATEGORY_CODE_CHATS:
                return (new ChatsMetadata())->fromArray($metadata);
            case BaseUnsortedModel::CATEGORY_CODE_FORMS:
                return (new FormsMetadata())->fromArray($metadata);
            case BaseUnsortedModel::CATEGORY_CODE_SIP:
                return (new SipMetadata())->fromArray($metadata);
            case BaseUnsortedModel::CATEGORY_CODE_MAIL:
                return (new MailMetadata())->fromArray($metadata);
        }

        throw new BadTypeException('Given category is not supported - ' . $category);
    }
}

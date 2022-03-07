<?php

namespace AmoCRM\Models\ShortLinks;

use AmoCRM\Models\BaseApiModel;
use InvalidArgumentException;

/**
 * Class ShortLinkModel
 *
 * @package AmoCRM\Models
 */
class ShortLinkModel extends BaseApiModel
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var string|null
     */
    protected $entityType;

    /**
     * @var int|null
     */
    protected $entityId;

    /**
     * @param array $shortLink
     *
     * @return self
     */
    public static function fromArray(array $shortLink)
    {
        if (empty($shortLink['url'])) {
            throw new InvalidArgumentException('shortLink url is empty in ' . json_encode($shortLink));
        }

        $model = new self();

        $model
            ->setUrl($shortLink['url'])
            ->setEntityId($shortLink['metadata']['entity_id'])
            ->setEntityType($shortLink['metadata']['entity_type']);

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'url' => $this->getUrl(),
            'entity_id' => $this->getEntityId(),
            'entity_type' => $this->getEntityType(),
        ];
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return ShortLinkModel
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEntityType()
    {
        return $this->entityType;
    }

    /**
     * @param string|null $entityType
     *
     * @return ShortLinkModel
     */
    public function setEntityType($entityType)
    {
        $this->entityType = $entityType;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getEntityId()
    {
        return $this->entityId;
    }

    /**
     * @param int|null $entityId
     *
     * @return ShortLinkModel
     */
    public function setEntityId($entityId)
    {
        $this->entityId = $entityId;

        return $this;
    }

    /**
     * @param string|null $requestId
     * @return array
     */
    public function toApi($requestId = "0")
    {
        return [
            'url' => $this->getUrl(),
            'metadata' => [
                'entity_id' => $this->getEntityId(),
                'entity_type' => $this->getEntityType(),
            ],
        ];
    }
}

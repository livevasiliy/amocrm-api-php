<?php

namespace AmoCRM\Models;

class LinkModel extends BaseApiModel
{
    /** @var int|null */
    protected $entityId;

    /** @var string|null */
    protected $entityType;

    /**
     * @var int|null
     */
    protected $toEntityId;

    /**
     * @var null|string
     */
    protected $toEntityType;

    /**
     * @var array|null
     */
    protected $metadata;

    /**
     * @return int|null
     */
    public function getToEntityId()
    {
        return $this->toEntityId;
    }

    /**
     * @param int|null $toEntityId
     *
     * @return LinkModel
     */
    public function setToEntityId($toEntityId)
    {
        $this->toEntityId = $toEntityId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getToEntityType()
    {
        return $this->toEntityType;
    }

    /**
     * @param string|null $toEntityType
     *
     * @return LinkModel
     */
    public function setToEntityType($toEntityType)
    {
        $this->toEntityType = $toEntityType;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * @param array|null $metadata
     *
     * @return LinkModel
     */
    public function setMetadata($metadata)
    {
        $this->metadata = $metadata;

        return $this;
    }

    public function getEntityId()
    {
        return $this->entityId;
    }

    public function setEntityId($entityId)
    {
        $this->entityId = $entityId;

        return $this;
    }

    public function getEntityType()
    {
        return $this->entityType;
    }

    public function setEntityType($entityType)
    {
        $this->entityType = $entityType;

        return $this;
    }

    /**
     * @param array $link
     *
     * @return self
     */
    public static function fromArray(array $link)
    {
        $model = new self();

        $model
            ->setEntityId(isset($link['entity_id']) ? $link['entity_id'] : null)
            ->setEntityType(isset($link['entity_type']) ? $link['entity_type'] : null)
            ->setToEntityType(isset($link['to_entity_type']) ? $link['to_entity_type'] : null)
            ->setToEntityId(isset($link['to_entity_id']) ? $link['to_entity_id'] : null)
            ->setMetadata(isset($link['metadata']) ? $link['metadata'] : null);

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'entity_type' => $this->getEntityType(),
            'entity_id' => $this->getEntityId(),
            'to_entity_type' => $this->getToEntityType(),
            'to_entity_id' => $this->getToEntityId(),
            'metadata' => $this->getMetadata(),
        ];
    }

    public function toApi($requestId = "0")
    {
        return $this->toArray();
    }
}

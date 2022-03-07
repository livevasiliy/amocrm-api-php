<?php

namespace AmoCRM\Models;

use AmoCRM\Models\Interfaces\HasIdInterface;
use AmoCRM\Models\Traits\CallTrait;
use AmoCRM\Models\Traits\RequestIdTrait;

use function is_null;

/**
 * Class CallModel
 *
 * @package AmoCRM\Models
 */
class CallModel extends BaseApiModel implements HasIdInterface
{
    use CallTrait;
    use RequestIdTrait;

    /**
     * @var int|null
     */
    protected $id;

    /**
     * @var string|null
     */
    protected $direction;

    /**
     * @var int|null
     */
    protected $entityId;

    /**
     * @var string|null
     */
    protected $entityType;

    /**
     * @var BaseApiModel|null
     */
    protected $entity;

    /**
     * @var int|null
     */
    protected $responsibleUserId;

    /**
     * @var int|null
     */
    protected $createdBy;

    /**
     * @var int|null
     */
    protected $updatedBy;

    /**
     * @var int|null
     */
    protected $createdAt;

    /**
     * @var int|null
     */
    protected $updatedAt;

    /**
     * @param array $call
     *
     * @return self
     */
    public function fromArray(array $call)
    {
        $model = new static();

        if (isset($call['id'])) {
            $this->setId($call['id']);
        }

        if (isset($call['uniq']) && is_string($call['uniq'])) {
            $this->setUniq($call['uniq']);
        }

        if (isset($call['duration'])) {
            $this->setDuration($call['duration']);
        }

        if (isset($call['source'])) {
            $this->setSource($call['source']);
        }

        if (isset($call['link'])) {
            $this->setLink($call['link']);
        }

        if (isset($call['phone'])) {
            $this->setPhone($call['phone']);
        }

        if (isset($call['call_result'])) {
            $this->setCallResult($call['call_result']);
        }

        if (isset($call['call_status'])) {
            $this->setCallStatus($call['call_status']);
        }

        if (isset($call['direction'])) {
            $this->setDirection($call['direction']);
        }



        return $model;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'uniq' => $this->getUniq(),
            'duration' => $this->getDuration(),
            'source' => $this->getSource(),
            'link' => $this->getLink(),
            'phone' => $this->getPhone(),
            'call_result' => $this->getCallResult(),
            'call_status' => $this->getCallStatus(),
            'direction' => $this->getDirection(),
            'entity_id' => $this->getEntityId(),
            'entity_type' => $this->getEntityType(),
            'entity' => $this->getEntity() ? $this->getEntity()->toArray() : null,
            'responsible_user_id' => $this->getResponsibleUserId(),
            'created_by' => $this->getCreatedBy(),
            'updated_by' => $this->getUpdatedBy(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
        ];
    }

    /**
     * @param string|null $requestId
     * @return array
     */
    public function toApi($requestId = "0")
    {
        if (is_null($this->getRequestId()) && !is_null($requestId)) {
            $this->setRequestId($requestId);
        }

        $call = [
            'uniq' => $this->getUniq(),
            'duration' => $this->getDuration(),
            'source' => $this->getSource(),
            'link' => $this->getLink(),
            'phone' => $this->getPhone(),
            'call_result' => $this->getCallResult(),
            'call_status' => $this->getCallStatus(),
            'direction' => $this->getDirection(),
            'request_id' => $this->getRequestId(),
        ];

        if ($responsibleUserId = $this->getResponsibleUserId()) {
            $call['responsible_user_id'] = $responsibleUserId;
        }

        if ($createdBy = $this->getCreatedBy()) {
            $call['created_by'] = $createdBy;
        }

        if ($updatedBy = $this->getUpdatedBy()) {
            $call['updated_by'] = $updatedBy;
        }

        if ($createdAt = $this->getCreatedAt()) {
            $call['created_at'] = $createdAt;
        }

        if ($updatedAt = $this->getUpdatedAt()) {
            $call['updated_at'] = $updatedAt;
        }

        return $call;
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return CallModel
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * @param string|null $direction
     *
     * @return CallModel
     */
    public function setDirection($direction)
    {
        $this->direction = $direction;

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
     * @return CallModel
     */
    public function setEntityId($entityId)
    {
        $this->entityId = $entityId;
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
     * @return CallModel
     */
    public function setEntityType($entityType)
    {
        $this->entityType = $entityType;

        return $this;
    }

    /**
     * @return BaseApiModel|null
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @param BaseApiModel|null $entity
     *
     * @return CallModel
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * @return null|int
     */
    public function getResponsibleUserId()
    {
        return $this->responsibleUserId;
    }

    /**
     * @param int $responsibleUserId
     *
     * @return CallModel
     */
    public function setResponsibleUserId($responsibleUserId)
    {
        $this->responsibleUserId = $responsibleUserId;

        return $this;
    }

    /**
     * @return null|int
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param int $createdBy
     *
     * @return CallModel
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return null|int
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * @param int $updatedBy
     *
     * @return CallModel
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * @return null|int
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param int $createdAt
     *
     * @return CallModel
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return null|int
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param int $updatedAt
     *
     * @return CallModel
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}

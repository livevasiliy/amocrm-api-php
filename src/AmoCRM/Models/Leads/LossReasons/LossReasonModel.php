<?php

namespace AmoCRM\Models\Leads\LossReasons;

use AmoCRM\Models\BaseApiModel;
use AmoCRM\Models\Interfaces\HasIdInterface;
use AmoCRM\Models\Traits\RequestIdTrait;
use InvalidArgumentException;

/**
 * Class LossReasonModel
 *
 * @package AmoCRM\Models\Leads\LossReasons
 */
class LossReasonModel extends BaseApiModel implements HasIdInterface
{
    use RequestIdTrait;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $sort;

    /**
     * @var int
     */
    protected $createdAt;

    /**
     * @var int
     */
    protected $updatedAt;

    /**
     * @param array $lossReason
     *
     * @return self
     */
    public static function fromArray(array $lossReason)
    {
        if (empty($lossReason['id'])) {
            throw new InvalidArgumentException('Loss reason id is empty in ' . json_encode($lossReason));
        }

        $lossReasonModel = new self();

        $lossReasonModel
            ->setId($lossReason['id'])
            ->setName($lossReason['name'])
            ->setSort($lossReason['sort'])
            ->setCreatedAt($lossReason['created_at'])
            ->setUpdatedAt($lossReason['updated_at']);

        return $lossReasonModel;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'sort' => $this->getSort(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
        ];
    }

    /**
     * @return null|int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return LossReasonModel
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return LossReasonModel
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @param int $sort
     *
     * @return LossReasonModel
     */
    public function setSort($sort)
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * @return int
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param int $timestamp
     *
     * @return LossReasonModel
     */
    public function setCreatedAt($timestamp)
    {
        $this->createdAt = $timestamp;

        return $this;
    }

    /**
     * @return int
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param int $timestamp
     *
     * @return LossReasonModel
     */
    public function setUpdatedAt($timestamp)
    {
        $this->updatedAt = $timestamp;

        return $this;
    }

    /**
     * @param string|null $requestId
     *
     * @return array
     */
    public function toApi($requestId = "0")
    {
        $result = [
            'name' => $this->getName(),
        ];

        if (is_null($this->getRequestId()) && !is_null($requestId)) {
            $this->setRequestId($requestId);
        }

        $result['request_id'] = $this->getRequestId();

        if (!is_null($this->getSort())) {
            $result['sort'] = $this->getSort();
        }

        return $result;
    }
}

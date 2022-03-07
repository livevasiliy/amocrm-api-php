<?php

namespace AmoCRM\Models;

/**
 * Class WebhookModel
 *
 * @package AmoCRM\Models
 */
class WebhookModel extends BaseApiModel
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $destination;

    /**
     * @var null|int
     */
    protected $createdAt;

    /**
     * @var null|int
     */
    protected $updatedAt;

    /**
     * @var null|int
     */
    protected $createdBy;

    /**
     * @var null|int
     */
    protected $accountId;

    /**
     * @var null|int
     */
    protected $sort;

    /**
     * @var bool|null
     */
    protected $disabled;

    /**
     * @var array|null
     */
    protected $settings;

    /**
     * @param array $webhook
     * @return self
     */
    public static function fromArray(array $webhook)
    {
        $model = new self();

        $model->setId($webhook['id'])
            ->setDestination($webhook['destination'])
            ->setAccountId($webhook['account_id'])
            ->setSettings($webhook['settings'])
            ->setCreatedBy($webhook['created_by'])
            ->setCreatedAt($webhook['created_at'])
            ->setUpdatedAt($webhook['updated_at'])
            ->setSort($webhook['sort'])
            ->setDisabled($webhook['disabled']);

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
        ];
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return WebhookModel
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param string $destination
     * @return WebhookModel
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param int|null $createdAt
     * @return WebhookModel
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param int|null $updatedAt
     * @return WebhookModel
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param int|null $createdBy
     * @return WebhookModel
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @param int|null $accountId
     * @return WebhookModel
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @param int|null $sort
     * @return WebhookModel
     */
    public function setSort($sort)
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getDisabled()
    {
        return $this->disabled;
    }

    /**
     * @param bool|null $disabled
     * @return WebhookModel
     */
    public function setDisabled($disabled)
    {
        $this->disabled = $disabled;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * @param array|null $settings
     * @return WebhookModel
     */
    public function setSettings($settings)
    {
        $this->settings = $settings;

        return $this;
    }

    /**
     * @param string|null $requestId
     * @return array
     */
    public function toApi($requestId = "0")
    {
        $result = [];

        if (!is_null($this->getDestination())) {
            $result['destination'] = $this->getDestination();
        }

        if (!is_null($this->getSort())) {
            $result['sort'] = $this->getSort();
        }

        if (!is_null($this->getSettings())) {
            $result['settings'] = $this->getSettings();
        }

        return $result;
    }

    /**
     * @return array
     */
    public function toUnsubscribeApi()
    {
        $result = [];

        if (!is_null($this->getDestination())) {
            $result['destination'] = $this->getDestination();
        }

        return $result;
    }
}

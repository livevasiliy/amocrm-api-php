<?php

namespace AmoCRM\Models;

use AmoCRM\Exceptions\NotAvailableForActionException;

class SubscriptionModel extends BaseApiModel
{
    const TYPE_USER = 'user';
    const TYPE_GROUP = 'group';
    /** @var int */
    protected $subscriberId;
    /** @var string */
    protected $type;

    /**
     * @param array $subscription
     *
     * @return self
     */
    public static function fromArray(array $subscription)
    {
        return (new static())
            ->setSubscriberId((int)$subscription['subscriber_id'])
            ->setType((string)$subscription['type']);
    }

    public function getSubscriberId()
    {
        return $this->subscriberId;
    }

    public function setSubscriberId($subscriberId)
    {
        $this->subscriberId = $subscriberId;

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function isUser()
    {
        return $this->getType() === self::TYPE_USER;
    }

    public function isGroup()
    {
        return $this->getType() === self::TYPE_GROUP;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'subscriber_id' => $this->getSubscriberId(),
            'type'          => $this->getType(),
        ];
    }

    /**
     * @param string|null $requestId
     *
     * @return array
     * @throws NotAvailableForActionException
     */
    public function toApi($requestId = "0")
    {
        throw new NotAvailableForActionException();
    }
}

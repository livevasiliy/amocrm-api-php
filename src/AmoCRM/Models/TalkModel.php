<?php

namespace AmoCRM\Models;

use AmoCRM\Exceptions\NotAvailableForActionException;

class TalkModel extends BaseApiModel
{
    /** @var int */
    protected $talkId;
    /** @var int */
    protected $createdAt;
    /** @var int */
    protected $updatedAt;
    /** @var int */
    protected $rate;
    /** @var int */
    protected $contactId;
    /** @var string|null */
    protected $chatId;
    /** @var int|null */
    protected $entityId;
    /** @var string|null */
    protected $entityType;
    /** @var bool */
    protected $isInWork;
    /** @var bool */
    protected $isRead;
    /** @var string */
    protected $origin;
    /** @var int|null */
    protected $missedAt;
    /** @var int */
    protected $accountId;

    /**
     * @param array $talk
     *
     * @return self
     */
    public static function fromArray(array $talk)
    {
        return (new static())
            ->setTalkId((int)$talk['talk_id'])
            ->setCreatedAt((int)$talk['created_at'])
            ->setUpdatedAt((int)$talk['updated_at'])
            ->setRate((int)$talk['rate'])
            ->setContactId((int)$talk['contact_id'])
            ->setChatId(empty($talk['chat_id']) ? null : (string)$talk['chat_id'])
            ->setEntityId(empty($talk['entity_id']) ?: (int)$talk['entity_id'])
            ->setEntityType(empty($talk['entity_type']) ?: (string)$talk['entity_type'])
            ->setIsInWork(!empty($talk['is_in_work']))
            ->setIsRead(!empty($talk['is_read']))
            ->setOrigin((string)(isset($talk['origin']) ? $talk['origin'] : ''))
            ->setMissedAt(empty($talk['missed_at']) ? null : (int)$talk['missed_at'])
            ->setAccountId((int)$talk['account_id']);
    }

    public function getTalkId()
    {
        return $this->talkId;
    }

    public function setTalkId($talkId)
    {
        $this->talkId = $talkId;

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getRate()
    {
        return $this->rate;
    }

    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    public function getContactId()
    {
        return $this->contactId;
    }

    public function setContactId($contactId)
    {
        $this->contactId = $contactId;

        return $this;
    }

    public function getChatId()
    {
        return $this->chatId;
    }

    public function setChatId($chatId)
    {
        $this->chatId = $chatId;

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

    public function isInWork()
    {
        return $this->isInWork;
    }

    public function setIsInWork($isInWork)
    {
        $this->isInWork = $isInWork;

        return $this;
    }

    public function isRead()
    {
        return $this->isRead;
    }

    public function setIsRead($isRead)
    {
        $this->isRead = $isRead;

        return $this;
    }

    public function getOrigin()
    {
        return $this->origin;
    }

    public function setOrigin($origin)
    {
        $this->origin = $origin;

        return $this;
    }

    public function getMissedAt()
    {
        return $this->missedAt;
    }

    public function setMissedAt($missedAt)
    {
        $this->missedAt = $missedAt;

        return $this;
    }

    public function getAccountId()
    {
        return $this->accountId;
    }

    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'talk_id'     => $this->getTalkId(),
            'created_at'  => $this->getCreatedAt(),
            'updated_at'  => $this->getUpdatedAt(),
            'rate'        => $this->getRate(),
            'contact_id'  => $this->getContactId(),
            'chat_id'     => $this->getChatId(),
            'entity_id'   => $this->getEntityId(),
            'entity_type' => $this->getEntityType(),
            'is_in_work'  => $this->isInWork(),
            'is_read'     => $this->isRead(),
            'origin'      => $this->getOrigin(),
            'missed_at'   => $this->getMissedAt(),
            'account_id'  => $this->getAccountId(),
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

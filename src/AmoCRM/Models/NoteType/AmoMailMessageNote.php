<?php

namespace AmoCRM\Models\NoteType;

use AmoCRM\Models\Factories\NoteFactory;
use AmoCRM\Models\NoteModel;

class AmoMailMessageNote extends NoParamNote
{
    protected $modelClass = AmoMailMessageNote::class;

    /** @var int */
    protected $threadId;

    /** @var int */
    protected $messageId;

    /** @var bool */
    protected $isPrivate;

    /** @var bool */
    protected $isIncome;

    /** @var array */
    protected $from;

    /** @var array */
    protected $to;

    /** @var string|null */
    protected $subject;

    /** @var string|null */
    protected $contentSummary;

    /** @var int */
    protected $attachCount;

    /** @var array|null */
    protected $deliveryStatus;

    public function getNoteType()
    {
        return NoteFactory::NOTE_TYPE_CODE_AMOMAIL_MESSAGE;
    }

    /**
     * @return int
     */
    public function getThreadId()
    {
        return $this->threadId;
    }

    /**
     * @param int $threadId
     *
     * @return AmoMailMessageNote
     */
    public function setThreadId($threadId)
    {
        $this->threadId = $threadId;

        return $this;
    }

    /**
     * @return int
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * @param int $messageId
     *
     * @return AmoMailMessageNote
     */
    public function setMessageId($messageId)
    {
        $this->messageId = $messageId;

        return $this;
    }

    /**
     * @return bool
     */
    public function getIsPrivate()
    {
        return $this->isPrivate;
    }

    /**
     * @param bool $isPrivate
     *
     * @return AmoMailMessageNote
     */
    public function setIsPrivate($isPrivate)
    {
        $this->isPrivate = $isPrivate;

        return $this;
    }

    /**
     * @return bool
     */
    public function getIsIncome()
    {
        return $this->isIncome;
    }

    /**
     * @param bool $isIncome
     *
     * @return AmoMailMessageNote
     */
    public function setIsIncome($isIncome)
    {
        $this->isIncome = $isIncome;

        return $this;
    }

    /**
     * @return array
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param array $from
     *
     * @return AmoMailMessageNote
     */
    public function setFrom(array $from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * @return array
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param array $to
     *
     * @return AmoMailMessageNote
     */
    public function setTo(array $to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string|null $subject
     *
     * @return AmoMailMessageNote
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getContentSummary()
    {
        return $this->contentSummary;
    }

    /**
     * @param string|null $contentSummary
     *
     * @return AmoMailMessageNote
     */
    public function setContentSummary($contentSummary)
    {
        $this->contentSummary = $contentSummary;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getAttachCount()
    {
        return $this->attachCount;
    }

    /**
     * @param int $attachCount
     *
     * @return AmoMailMessageNote
     */
    public function setAttachCount($attachCount)
    {
        $this->attachCount = $attachCount;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getDeliveryStatus()
    {
        return $this->deliveryStatus;
    }

    /**
     * @param array|null $deliveryStatus
     *
     * @return AmoMailMessageNote
     */
    public function setDeliveryStatus($deliveryStatus)
    {
        $this->deliveryStatus = $deliveryStatus;

        return $this;
    }

    /**
     * @param array $note
     *
     * @return NoteModel
     */
    public function fromArray(array $note)
    {
        $model = parent::fromArray($note);

        if (isset($note['params']['thread_id'])) {
            $model->setThreadId($note['params']['thread_id']);
        }

        if (isset($note['params']['message_id'])) {
            $model->setMessageId($note['params']['message_id']);
        }

        if (isset($note['params']['private'])) {
            $model->setIsPrivate((bool)$note['params']['private']);
        }

        if (isset($note['params']['income'])) {
            $model->setIsIncome((bool)$note['params']['income']);
        }

        if (isset($note['params']['from'])) {
            $model->setFrom((array)$note['params']['from']);
        }

        if (isset($note['params']['to'])) {
            $model->setTo((array)$note['params']['to']);
        }

        if (isset($note['params']['subject'])) {
            $model->setSubject($note['params']['subject']);
        }

        if (isset($note['params']['content_summary'])) {
            $model->setContentSummary($note['params']['content_summary']);
        }

        if (isset($note['params']['attach_cnt'])) {
            $model->setAttachCount(($note['params']['attach_cnt']));
        }

        if (isset($note['params']['delivery'])) {
            $model->setDeliveryStatus($note['params']['delivery']);
        }

        return $model;
    }
}

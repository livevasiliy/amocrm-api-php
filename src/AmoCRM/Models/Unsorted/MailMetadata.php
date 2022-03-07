<?php

namespace AmoCRM\Models\Unsorted;

use AmoCRM\Models\Unsorted\Interfaces\UnsortedMetadataInterface;
use AmoCRM\Models\BaseApiModel;
use Illuminate\Contracts\Support\Arrayable;

class MailMetadata extends BaseApiModel implements Arrayable, UnsortedMetadataInterface
{
    /**
     * @var array|null
     */
    protected $from;

    /**
     * @var string|null
     */
    protected $subject;

    /**
     * @var int|null
     */
    protected $receivedAt;

    /**
     * @var string|null
     */
    protected $threadId;

    /**
     * @var int|null
     */
    protected $messageId;

    /**
     * @var string|null
     */
    protected $contentSummary;

    /**
     * @param array $metadata
     *
     * @return self
     */
    public static function fromArray(array $metadata)
    {
        $model = new self();

        $model->setFrom($metadata['from']);
        $model->setReceivedAt($metadata['received_at']);
        $model->setSubject($metadata['subject']);
        $model->setThreadId($metadata['thread_id']);
        $model->setMessageId($metadata['message_id']);
        $model->setContentSummary($metadata['content_summary']);

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'from' => [
                'email' => $this->getFrom()['email'],
                'name' => $this->getFrom()['name'],
            ],
            'received_at' => $this->getReceivedAt(),
            'subject' => $this->getSubject(),
            'thread_id' => $this->getThreadId(),
            'message_id' => $this->getMessageId(),
            'content_summary' => $this->getContentSummary(),
        ];
    }

    /**
     * @return array|null
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param array|null $from
     *
     * @return MailMetadata
     */
    public function setFrom($from)
    {
        $this->from = $from;

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
     * @return MailMetadata
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getReceivedAt()
    {
        return $this->receivedAt;
    }

    /**
     * @param int|null $receivedAt
     *
     * @return MailMetadata
     */
    public function setReceivedAt($receivedAt)
    {
        $this->receivedAt = $receivedAt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getThreadId()
    {
        return $this->threadId;
    }

    /**
     * @param string|null $threadId
     *
     * @return MailMetadata
     */
    public function setThreadId($threadId)
    {
        $this->threadId = $threadId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * @param int|null $messageId
     *
     * @return MailMetadata
     */
    public function setMessageId($messageId)
    {
        $this->messageId = $messageId;

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
     * @return MailMetadata
     */
    public function setContentSummary($contentSummary)
    {
        $this->contentSummary = $contentSummary;

        return $this;
    }

    /**
     * @param string|null $requestId
     * @return array
     */
    public function toApi($requestId = "0")
    {
        return [];
    }


    /**
     * @return array
     */
    public function toComplexApi()
    {
        $result = $this->toApi();

        $result['category'] = BaseUnsortedModel::CATEGORY_CODE_MAIL;

        return $result;
    }
}

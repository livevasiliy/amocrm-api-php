<?php

namespace AmoCRM\Models\Unsorted;

use AmoCRM\Models\Unsorted\Interfaces\UnsortedMetadataInterface;
use AmoCRM\Models\BaseApiModel;
use Illuminate\Contracts\Support\Arrayable;

class ChatsMetadata extends BaseApiModel implements Arrayable, UnsortedMetadataInterface
{
    /**
     * @var string|null
     */
    protected $from;

    /**
     * @var string|null
     */
    protected $to;

    /**
     * @var int|null
     */
    protected $receivedAt;

    /**
     * @var string|null
     */
    protected $service;

    /**
     * @var array|null
     */
    protected $client;

    /**
     * @var array|null
     */
    protected $origin;

    /**
     * @var string|null
     */
    protected $lastMessageText;

    /**
     * @var string|null
     */
    protected $sourceName;

    /**
     * @param array $metadata
     *
     * @return self
     */
    public static function fromArray(array $metadata)
    {
        $model = new self();

        $model->setFrom($metadata['from']);
        $model->setTo($metadata['to']);
        $model->setReceivedAt($metadata['received_at']);
        $model->setService($metadata['service']);
        $model->setClient($metadata['client']);
        $model->setOrigin($metadata['origin']);
        $model->setLastMessageText($metadata['last_message_text']);
        $model->setSourceName($metadata['source_name']);

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'from' => $this->getFrom(),
            'to' => $this->getTo(),
            'received_at' => $this->getReceivedAt(),
            'service' => $this->getService(),
            'client' => [
                'name' => isset($this->getClient()['name']) ? $this->getClient()['name'] : null,
                'avatar' => isset($this->getClient()['avatar']) ? $this->getClient()['avatar'] : null,
            ],
            'origin' => [
                'chat_id' => isset($this->getOrigin()['chat_id']) ? $this->getOrigin()['chat_id'] : null,
                'ref' => isset($this->getOrigin()['ref']) ? $this->getOrigin()['ref'] : null,
                'visitor_uid' => isset($this->getOrigin()['visitor_uid']) ? $this->getOrigin()['visitor_uid'] : null,
            ],
            'last_message_text' => $this->getLastMessageText(),
            'source_name' => $this->getSourceName(),
        ];
    }

    /**
     * @return string|null
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param string|null $from
     * @return ChatsMetadata
     */
    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param string|null $to
     * @return ChatsMetadata
     */
    public function setTo($to)
    {
        $this->to = $to;

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
     * @return ChatsMetadata
     */
    public function setReceivedAt($receivedAt)
    {
        $this->receivedAt = $receivedAt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param string|null $service
     * @return ChatsMetadata
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param array|null $client
     * @return ChatsMetadata
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * @param array|null $origin
     * @return ChatsMetadata
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastMessageText()
    {
        return $this->lastMessageText;
    }

    /**
     * @param string|null $lastMessageText
     * @return ChatsMetadata
     */
    public function setLastMessageText($lastMessageText)
    {
        $this->lastMessageText = $lastMessageText;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSourceName()
    {
        return $this->sourceName;
    }

    /**
     * @param string|null $sourceName
     * @return ChatsMetadata
     */
    public function setSourceName($sourceName)
    {
        $this->sourceName = $sourceName;

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

        $result['category'] = BaseUnsortedModel::CATEGORY_CODE_CHATS;

        return $result;
    }
}

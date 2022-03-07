<?php

namespace AmoCRM\Models\NoteType;

use AmoCRM\Models\Factories\NoteFactory;
use AmoCRM\Exceptions\InvalidArgumentException;
use AmoCRM\Models\NoteModel;

class MessageCashierNote extends NoteModel
{
    protected $modelClass = MessageCashierNote::class;

    const STATUS_CREATED = 'created';
    const STATUS_SHOWN = 'shown';
    const STATUS_CANCELED = 'canceled';

    const AVAILABLE_STATUSES = [
        self::STATUS_CANCELED,
        self::STATUS_CREATED,
        self::STATUS_SHOWN,
    ];

    /**
     * @var null|string
     */
    protected $status;

    /**
     * @var null|string
     */
    protected $text;

    public function getNoteType()
    {
        return NoteFactory::NOTE_TYPE_CODE_MESSAGE_CASHIER;
    }

    /**
     * @param array $note
     *
     * @return NoteModel
     * @throws InvalidArgumentException
     */
    public function fromArray(array $note)
    {
        $model = parent::fromArray($note);

        if (isset($note['params']['status'])) {
            $model->setStatus($note['params']['status']);
        }

        if (isset($note['params']['text'])) {
            $model->setText($note['params']['text']);
        }

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        $result = parent::toArray();

        $result['params']['status'] = $this->getStatus();
        $result['params']['text'] = $this->getText();

        return $result;
    }

    /**
     * @param string|null $requestId
     * @return array
     */
    public function toApi($requestId = "0")
    {
        $result = parent::toApi($requestId);

        $result['params']['status'] = $this->getStatus();
        $result['params']['text'] = $this->getText();

        return $result;
    }

    /**
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     *
     * @return MessageCashierNote
     * @throws InvalidArgumentException
     */
    public function setStatus($status)
    {
        if (!in_array($status, self::AVAILABLE_STATUSES, true)) {
            throw new InvalidArgumentException('Invalid value given:' . $status);
        }

        $this->status = $status;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string|null $text
     * @return MessageCashierNote
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }
}

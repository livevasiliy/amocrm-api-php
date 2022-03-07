<?php

namespace AmoCRM\Models\NoteType;

use AmoCRM\Models\NoteModel;

abstract class SmsNote extends NoteModel
{
    /**
     * @var null|string
     */
    protected $text;

    /**
     * @var null|string
     */
    protected $phone;

    /**
     * @param array $note
     *
     * @return NoteModel
     */
    public function fromArray(array $note)
    {
        $model = parent::fromArray($note);

        if (isset($note['params']['text'])) {
            $model->setText($note['params']['text']);
        }

        if (isset($note['params']['phone'])) {
            $model->setPhone($note['params']['phone']);
        }

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        $result = parent::toArray();

        $result['params'] = [
            'text' => $this->getText(),
            'phone' => $this->getPhone(),
        ];

        return $result;
    }

    /**
     * @param string|null $requestId
     * @return array
     */
    public function toApi($requestId = "0")
    {
        $result = parent::toApi($requestId);

        $result['params'] = [
            'text' => $this->getText(),
            'phone' => $this->getPhone(),
        ];

        return $result;
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
     * @return SmsNote
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     * @return SmsNote
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }
}

<?php

namespace AmoCRM\Models\NoteType;

use AmoCRM\Exceptions\NotAvailableForActionException;
use AmoCRM\Models\NoteModel;

abstract class OnlyTextParamNote extends NoteModel
{
    /**
     * @var null|string
     */
    protected $text;

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

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        $result = parent::toArray();

        $result['params']['text'] = $this->getText();

        return $result;
    }

    /**
     * @param string|null $requestId
     * @return array
     * @throws NotAvailableForActionException
     */
    public function toApi($requestId = "0")
    {
        throw new NotAvailableForActionException();
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return NoteModel
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }
}

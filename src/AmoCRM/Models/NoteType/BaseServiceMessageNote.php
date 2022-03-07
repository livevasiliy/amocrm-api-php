<?php

namespace AmoCRM\Models\NoteType;

use AmoCRM\Models\NoteModel;

abstract class BaseServiceMessageNote extends NoteModel
{
    /**
     * @var null|string
     */
    protected $service;

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

        if (isset($note['params']['service'])) {
            $model->setService($note['params']['service']);
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

        $result['params']['service'] = $this->getService();
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

        $result['params']['service'] = $this->getService();
        $result['params']['text'] = $this->getText();

        return $result;
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
     * @return BaseServiceMessageNote
     */
    public function setService($service)
    {
        $this->service = $service;

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
     * @return BaseServiceMessageNote
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }
}

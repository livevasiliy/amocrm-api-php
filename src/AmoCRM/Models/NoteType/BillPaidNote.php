<?php

namespace AmoCRM\Models\NoteType;

use AmoCRM\Models\Factories\NoteFactory;
use AmoCRM\Models\NoteModel;

class BillPaidNote extends NoteModel
{
    protected $modelClass = BillPaidNote::class;

    /**
     * @var null|string
     */
    protected $service;

    /**
     * @var null|string
     */
    protected $iconUrl;

    /**
     * @var null|string
     */
    protected $text;

    public function getNoteType()
    {
        return NoteFactory::NOTE_TYPE_CODE_BILL_PAID;
    }

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

        if (isset($note['params']['icon_url'])) {
            $model->setIconUrl($note['params']['icon_url']);
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
        $result['params']['icon_url'] = $this->getIconUrl();

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
        $result['params']['icon_url'] = $this->getIconUrl();

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
     * @return BillPaidNote
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIconUrl()
    {
        return $this->iconUrl;
    }

    /**
     * @param string|null $iconUrl
     * @return BillPaidNote
     */
    public function setIconUrl($iconUrl)
    {
        $this->iconUrl = $iconUrl;

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
     * @return BillPaidNote
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }
}

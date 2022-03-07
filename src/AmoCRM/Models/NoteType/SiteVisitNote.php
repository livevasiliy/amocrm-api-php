<?php

namespace AmoCRM\Models\NoteType;

use AmoCRM\Models\Factories\NoteFactory;
use AmoCRM\Models\NoteModel;

class SiteVisitNote extends NoteModel
{
    protected $modelClass = SiteVisitNote::class;

    /**
     * @var null|string
     */
    protected $url;

    public function getNoteType()
    {
        return NoteFactory::NOTE_TYPE_CODE_SITE_VISIT;
    }

    /**
     * @param array $note
     *
     * @return NoteModel
     */
    public function fromArray(array $note)
    {
        $model = parent::fromArray($note);

        if (isset($note['params']['url'])) {
            $model->setUrl($note['params']['url']);
        }

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        $result = parent::toArray();

        $result['params']['url'] = $this->getUrl();

        return $result;
    }

    /**
     * @param string|null $requestId
     * @return array
     */
    public function toApi($requestId = "0")
    {
        $result = parent::toApi($requestId);

        $result['params']['url'] = $this->getUrl();

        return $result;
    }

    /**
     * @return string|null
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     * @return SiteVisitNote
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }
}

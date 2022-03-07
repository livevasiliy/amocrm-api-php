<?php

namespace AmoCRM\Models\NoteType;

use AmoCRM\Models\Factories\NoteFactory;
use AmoCRM\Exceptions\NotAvailableForActionException;
use AmoCRM\Models\NoteModel;

class FollowedLinkNote extends NoteModel
{
    protected $modelClass = FollowedLinkNote::class;

    /**
     * @var null|string
     */
    protected $url;

    public function getNoteType()
    {
        return NoteFactory::NOTE_TYPE_CODE_LINK_FOLLOWED;
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
     * @throws NotAvailableForActionException
     */
    public function toApi($requestId = "0")
    {
        throw new NotAvailableForActionException();
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
     * @return FollowedLinkNote
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }
}

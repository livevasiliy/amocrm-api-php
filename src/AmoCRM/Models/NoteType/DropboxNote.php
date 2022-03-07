<?php

namespace AmoCRM\Models\NoteType;

use AmoCRM\Models\Factories\NoteFactory;
use AmoCRM\Exceptions\NotAvailableForActionException;
use AmoCRM\Models\NoteModel;

class DropboxNote extends NoteModel
{
    protected $modelClass = DropboxNote::class;

    /**
     * @var null|string
     */
    protected $link;

    /**
     * @var null|string
     */
    protected $filename;

    public function getNoteType()
    {
        return NoteFactory::NOTE_TYPE_CODE_DROPBOX;
    }

    /**
     * @param array $note
     *
     * @return NoteModel
     */
    public function fromArray(array $note)
    {
        $model = parent::fromArray($note);

        if (isset($note['params']['link'])) {
            $model->setLink($note['params']['link']);
        }

        if (isset($note['params']['filename'])) {
            $model->setFilename($note['params']['filename']);
        }

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        $result = parent::toArray();

        $result['params']['link'] = $this->getLink();
        $result['params']['filename'] = $this->getFilename();

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
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string|null $link
     * @return DropboxNote
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param string|null $filename
     * @return DropboxNote
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }
}

<?php

namespace AmoCRM\Models\NoteType;

use AmoCRM\Models\Factories\NoteFactory;
use AmoCRM\Exceptions\NotAvailableForActionException;
use AmoCRM\Models\NoteModel;

class AttachmentNote extends NoteModel
{
    protected $modelClass = AttachmentNote::class;

    /**
     * @var null|string
     */
    protected $originalName;

    /**
     * @var null|string
     */
    protected $attachment;

    /**
     * @return string
     */
    public function getNoteType()
    {
        return NoteFactory::NOTE_TYPE_CODE_ATTACHMENT;
    }

    /**
     * @param array $note
     *
     * @return NoteModel
     */
    public function fromArray(array $note)
    {
        $model = parent::fromArray($note);

        if (isset($note['params']['original_name'])) {
            $model->setOriginalName($note['params']['original_name']);
        }

        if (isset($note['params']['attachment'])) {
            $model->setAttachment($note['params']['attachment']);
        }

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        $result = parent::toArray();

        $result['params']['original_name'] = $this->getOriginalName();
        $result['params']['attachment'] = $this->getAttachment();

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
    public function getOriginalName()
    {
        return $this->originalName;
    }

    /**
     * @param string|null $originalName
     * @return AttachmentNote
     */
    public function setOriginalName($originalName)
    {
        $this->originalName = $originalName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAttachment()
    {
        return $this->attachment;
    }

    /**
     * @param string|null $attachment
     * @return AttachmentNote
     */
    public function setAttachment($attachment)
    {
        $this->attachment = $attachment;

        return $this;
    }
}

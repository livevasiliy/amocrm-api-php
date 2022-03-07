<?php

namespace AmoCRM\Models\NoteType;

use AmoCRM\Models\Factories\NoteFactory;
use AmoCRM\Models\NoteModel;

class ZoomMeetingNote extends NoteModel
{
    protected $modelClass = ZoomMeetingNote::class;

    /**
     * @var null|array
     */
    protected $conference;

    /**
     * @var null|array
     */
    protected $recordings;

    public function getNoteType()
    {
        return NoteFactory::NOTE_TYPE_CODE_ZOOM_MEETING;
    }

    /**
     * @param array $note
     *
     * @return NoteModel
     */
    public function fromArray(array $note)
    {
        $model = parent::fromArray($note);

        if (isset($note['params']['recordings'])) {
            $model->setRecordings($note['params']['recordings']);
        }

        if (isset($note['params']['conference'])) {
            $model->setConference($note['params']['conference']);
        }

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        $result = parent::toArray();

        $result['params']['conference'] = $this->getConference();
        $result['params']['recordings'] = $this->getRecordings();

        return $result;
    }

    /**
     * @param string|null $requestId
     * @return array
     */
    public function toApi($requestId = "0")
    {
        $result = parent::toApi($requestId);

        $result['params']['conference'] = $this->getConference();
        $result['params']['recordings'] = $this->getRecordings();

        return $result;
    }

    /**
     * @return array|null
     */
    public function getConference()
    {
        return $this->conference;
    }

    /**
     * @param array|null $conference
     * @return ZoomMeetingNote
     */
    public function setConference($conference)
    {
        $this->conference = $conference;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getRecordings()
    {
        return $this->recordings;
    }

    /**
     * @param array|null $recordings
     * @return ZoomMeetingNote
     */
    public function setRecordings($recordings)
    {
        $this->recordings = $recordings;

        return $this;
    }
}

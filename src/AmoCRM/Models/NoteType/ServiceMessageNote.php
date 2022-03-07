<?php

namespace AmoCRM\Models\NoteType;

use AmoCRM\Models\Factories\NoteFactory;

class ServiceMessageNote extends BaseServiceMessageNote
{
    protected $modelClass = ServiceMessageNote::class;

    public function getNoteType()
    {
        return NoteFactory::NOTE_TYPE_CODE_SERVICE_MESSAGE;
    }
}

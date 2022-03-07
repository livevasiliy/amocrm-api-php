<?php

namespace AmoCRM\Models\NoteType;

use AmoCRM\Models\Factories\NoteFactory;

class ExtendedServiceMessageNote extends BaseServiceMessageNote
{
    protected $modelClass = ExtendedServiceMessageNote::class;

    public function getNoteType()
    {
        return NoteFactory::NOTE_TYPE_CODE_EXTENDED_SERVICE_MESSAGE;
    }
}

<?php

namespace AmoCRM\Models\NoteType;

use AmoCRM\Models\Factories\NoteFactory;

class CallInNote extends CallNote
{
    protected $modelClass = CallInNote::class;

    public function getNoteType()
    {
        return NoteFactory::NOTE_TYPE_CODE_CALL_IN;
    }
}

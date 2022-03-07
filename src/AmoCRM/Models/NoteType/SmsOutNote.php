<?php

namespace AmoCRM\Models\NoteType;

use AmoCRM\Models\Factories\NoteFactory;

class SmsOutNote extends SmsNote
{
    protected $modelClass = SmsOutNote::class;

    public function getNoteType()
    {
        return NoteFactory::NOTE_TYPE_CODE_SMS_OUT;
    }
}

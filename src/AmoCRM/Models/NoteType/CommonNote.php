<?php

namespace AmoCRM\Models\NoteType;

use AmoCRM\Models\Factories\NoteFactory;
use AmoCRM\Models\NoteModel;

class CommonNote extends OnlyTextParamNote
{
    protected $modelClass = CommonNote::class;

    /**
     * @param string|null $requestId
     * @return array
     */
    public function toApi($requestId = "0")
    {
        $result = NoteModel::toApi($requestId);

        $result['params']['text'] = $this->getText();

        return $result;
    }

    public function getNoteType()
    {
        return NoteFactory::NOTE_TYPE_CODE_COMMON;
    }
}

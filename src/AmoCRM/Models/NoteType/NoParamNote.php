<?php

namespace AmoCRM\Models\NoteType;

use AmoCRM\Exceptions\NotAvailableForActionException;
use AmoCRM\Models\NoteModel;

abstract class NoParamNote extends NoteModel
{
    /**
     * @param string|null $requestId
     * @return array
     * @throws NotAvailableForActionException
     */
    public function toApi($requestId = "0")
    {
        throw new NotAvailableForActionException();
    }
}

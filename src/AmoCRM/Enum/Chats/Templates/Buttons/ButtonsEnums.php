<?php

namespace AmoCRM\Enum\Chats\Templates\Buttons;

class ButtonsEnums
{
    const TYPE_TEXT = 'inline';
    const TYPE_URL = 'url';

    /**
     * @return string[]
     */
    public static function getAll()
    {
        return [
            self::TYPE_TEXT,
            self::TYPE_URL,
        ];
    }
}

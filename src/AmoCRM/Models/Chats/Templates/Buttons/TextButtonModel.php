<?php

namespace AmoCRM\Models\Chats\Templates\Buttons;

use AmoCRM\Enum\Chats\Templates\Buttons\ButtonsEnums;

/**
 * Class TextButtonModel
 *
 * @package AmoCRM\Models\Chats\Templates\Buttons
 */
class TextButtonModel extends AbstractButtonModel
{
    /**
     * @var string
     */
    protected $text;

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'type' => ButtonsEnums::TYPE_TEXT,
            'text' => $this->getText(),
        ];
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     *
     * @return TextButtonModel
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }
}

<?php

namespace AmoCRM\Models\Chats\Templates\Buttons;

use AmoCRM\Enum\Chats\Templates\Buttons\ButtonsEnums;

/**
 * Class UrlButtonModel
 *
 * @package AmoCRM\Models\Chats\Templates\Buttons
 */
class UrlButtonModel extends TextButtonModel
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'type' => ButtonsEnums::TYPE_URL,
            'text' => $this->getText(),
            'url' => $this->getUrl(),
        ];
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return UrlButtonModel
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }
}

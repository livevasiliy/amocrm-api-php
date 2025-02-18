<?php

namespace AmoCRM\Models\Chats\Templates\Buttons;

use AmoCRM\Enum\Chats\Templates\Buttons\ButtonsEnums;
use AmoCRM\Exceptions\InvalidArgumentException;
use AmoCRM\Models\BaseApiModel;
use Illuminate\Contracts\Support\Arrayable;

/**
 * Class AbstractButtonModel
 *
 * @package AmoCRM\Models\Chats\Templates\Buttons
 */
abstract class AbstractButtonModel extends BaseApiModel implements Arrayable
{
    /**
     * @param array $button
     *
     * @return AbstractButtonModel
     * @throws InvalidArgumentException
     */
    public static function fromArray(array $button)
    {
        if (empty($button['type']) || !in_array($button['type'], ButtonsEnums::getAll(), true)) {
            throw new InvalidArgumentException('Button type missed');
        }

        switch ($button['type']) {
            case ButtonsEnums::TYPE_URL:
                $model = new UrlButtonModel();
                $model->setUrl($button['url']);
                break;
            case ButtonsEnums::TYPE_TEXT:
                $model = new TextButtonModel();
                break;
        }

        $model->setText($button['text']);

        return $model;
    }

    /**
     * @param string|null $requestId
     * @return array
     */
    public function toApi($requestId = "0")
    {
        return $this->toArray();
    }
}

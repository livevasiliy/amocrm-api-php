<?php

namespace AmoCRM\Models;

use function is_null;

/**
 * Class ProductsSettings
 *
 * @package AmoCRM\Models
 */
class ProductsSettingsModel extends BaseApiModel
{
    /** @var bool|null */
    protected $isEnabled;

    /**
     * @return bool|null
     */
    public function isEnabled()
    {
        return $this->isEnabled;
    }

    /**
     * @param bool|null $isEnabled
     *
     * @return ProductsSettingsModel
     */
    public function setIsEnabled($isEnabled)
    {
        $this->isEnabled = $isEnabled;

        return $this;
    }


    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'is_enabled' => $this->isEnabled(),
        ];
    }

    /**
     * @param array $settings
     *
     * @return ProductsSettingsModel
     */
    public static function fromArray(array $settings)
    {
        $model = new self();

        $model->setIsEnabled($settings['is_enabled']);

        return $model;
    }

    /**
     * @param string|null $requestId
     * @return array
     */
    public function toApi($requestId = "0")
    {
        $result = [];

        if (!is_null($this->isEnabled())) {
            $result['is_enabled'] = $this->isEnabled();
        }

        return $result;
    }
}

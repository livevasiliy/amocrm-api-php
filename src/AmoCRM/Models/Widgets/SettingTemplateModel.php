<?php

namespace AmoCRM\Models\Widgets;

use AmoCRM\Models\BaseApiModel;
use Illuminate\Contracts\Support\Arrayable;

class SettingTemplateModel extends BaseApiModel implements Arrayable
{
    /**
     * @var string|null
     */
    protected $key;

    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var string|null
     */
    protected $type;

    /**
     * @var bool|null
     */
    protected $isRequired;

    /**
     * @param array $template
     *
     * @return self
     */
    public static function fromArray(array $template)
    {
        $model = new self();

        $model
            ->setKey($template['key'])
            ->setName($template['name'])
            ->setType($template['type'])
            ->setIsRequired($template['is_required']);

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'key' => $this->getKey(),
            'name' => $this->getName(),
            'type' => $this->getType(),
            'is_required' => $this->getIsRequired(),
        ];
    }

    /**
     * @return string|null
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string|null $key
     *
     * @return SettingTemplateModel
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     *
     * @return SettingTemplateModel
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     *
     * @return SettingTemplateModel
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsRequired()
    {
        return $this->isRequired;
    }

    /**
     * @param bool|null $isRequired
     *
     * @return SettingTemplateModel
     */
    public function setIsRequired($isRequired)
    {
        $this->isRequired = $isRequired;

        return $this;
    }

    /**
     * @param string|null $requestId
     * @return array
     */
    public function toApi($requestId = "0")
    {
        return [];
    }
}

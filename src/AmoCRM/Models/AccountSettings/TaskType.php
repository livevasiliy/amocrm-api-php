<?php

namespace AmoCRM\Models\AccountSettings;

use AmoCRM\Models\BaseApiModel;
use Illuminate\Contracts\Support\Arrayable;

class TaskType extends BaseApiModel implements Arrayable
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string|null
     */
    protected $color;

    /**
     * @var int|null
     */
    protected $iconId;

    /**
     * @var string|null
     */
    protected $code;

    /**
     * @param  array  $type
     *
     * @return self
     */
    public static function fromArray(array $type)
    {
        $model = new self();

        $model->setId($type['id']);
        $model->setName($type['name']);
        $model->setColor($type['color']);
        $model->setIconId($type['icon_id']);
        $model->setCode($type['code']);

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'color' => $this->getColor(),
            'icon_id' => $this->getIconId(),
            'code' => $this->getCode(),
        ];
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param  int  $id
     * @return  void
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param  string  $name
     *
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param  string|null  $color
     *
     * @return void
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @return int|null
     */
    public function getIconId()
    {
        return $this->iconId;
    }

    /**
     * @param  int|null  $iconId
     *
     * @return void
     */
    public function setIconId($iconId)
    {
        $this->iconId = $iconId;
    }

    /**
     * @return string|null
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param  string|null  $code
     *
     * @return void
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @param  string|null  $requestId
     * @return array
     */
    public function toApi($requestId = "0")
    {
        return [];
    }
}

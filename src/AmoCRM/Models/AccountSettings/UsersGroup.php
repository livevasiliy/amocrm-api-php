<?php

namespace AmoCRM\Models\AccountSettings;

use AmoCRM\Models\BaseApiModel;
use Illuminate\Contracts\Support\Arrayable;

class UsersGroup extends BaseApiModel implements Arrayable
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
     * @var string
     */
    protected $uuid;

    /**
     * @param array $group
     *
     * @return self
     */
    public static function fromArray(array $group)
    {
        $model = new self();

        $model->setId($group['id'])
            ->setName($group['name']);

        if (!empty($group['uuid'])) {
            $model->setUuid($group['uuid']);
        }

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        $result = [
            'id' => $this->id,
            'name' => $this->name,
        ];

        if ($this->getUuid()) {
            $result['uuid'] = $this->getUuid();
        }

        return $result;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return UsersGroup
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return UsersGroup
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     * @return UsersGroup
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

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

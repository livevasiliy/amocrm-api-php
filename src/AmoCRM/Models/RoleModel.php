<?php

namespace AmoCRM\Models;

use AmoCRM\Client\AmoCRMApiRequest;
use AmoCRM\Collections\UsersCollection;
use AmoCRM\Helpers\EntityTypesInterface;
use AmoCRM\Models\Interfaces\HasIdInterface;
use AmoCRM\Models\Rights\RightModel;
use AmoCRM\Models\Traits\RequestIdTrait;
use InvalidArgumentException;

use function is_null;

class RoleModel extends BaseApiModel implements HasIdInterface
{
    use RequestIdTrait;

    const USERS = 'users';

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var UsersCollection
     */
    protected $users;

    /**
     * @var RightModel
     */
    protected $rights;

    /**
     * @param array $role
     *
     * @return self
     */
    public static function fromArray(array $role)
    {
        if (empty($role['id'])) {
            throw new InvalidArgumentException('Role id is empty in ' . json_encode($role));
        }

        $roleModel = new self();

        $roleModel
            ->setId($role['id'])
            ->setName($role['name']);

        //Права возвращаются только в сервисе ролей, но при этом модель используется и в сервисе пользователей
        if (isset($role['rights'])) {
            $roleModel->setRights(RightModel::fromArray($role['rights']));
        }

        $usersCollection = new UsersCollection();
        if (!empty($role[AmoCRMApiRequest::EMBEDDED][EntityTypesInterface::USERS])) {
            $usersCollection = $usersCollection->fromArray($role[AmoCRMApiRequest::EMBEDDED][EntityTypesInterface::USERS]);
        }
        $roleModel->setUsers($usersCollection);


        return $roleModel;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'right' => is_null($this->getRights()) ? null : $this->getRights()->toArray(),
            'users' => is_null($this->getUsers()) ? null : $this->getUsers()->toArray(),
        ];
    }

    /**
     * @return null|int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return RoleModel
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
     * @return RoleModel
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return null|UsersCollection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param UsersCollection $users
     * @return RoleModel
     */
    public function setUsers(UsersCollection $users)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @return null|RightModel
     */
    public function getRights()
    {
        return $this->rights;
    }

    /**
     * @param RightModel $rights
     * @return RoleModel
     */
    public function setRights(RightModel $rights)
    {
        $this->rights = $rights;

        return $this;
    }

    /**
     * @param string|null $requestId
     * @return array
     */
    public function toApi($requestId = "0")
    {
        $result = [];

        if (!is_null($this->getName())) {
            $result['name'] = $this->getName();
        }

        if (!is_null($this->getRights())) {
            $result['rights'] = $this->getRights()->toApi();
        }

        if (is_null($this->getRequestId()) && !is_null($requestId)) {
            $this->setRequestId($requestId);
        }

        $result['request_id'] = $this->getRequestId();

        return $result;
    }

    public static function getAvailableWith()
    {
        return [
            self::USERS,
        ];
    }
}

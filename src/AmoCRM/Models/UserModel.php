<?php

namespace AmoCRM\Models;

use AmoCRM\Client\AmoCRMApiRequest;
use AmoCRM\Collections\RolesCollection;
use AmoCRM\Collections\UsersGroupsCollection;
use AmoCRM\Helpers\EntityTypesInterface;
use AmoCRM\Models\Interfaces\HasIdInterface;
use AmoCRM\Models\Rights\RightModel;
use AmoCRM\Models\Traits\RequestIdTrait;
use InvalidArgumentException;

use function is_null;

class UserModel extends BaseApiModel implements HasIdInterface
{
    use RequestIdTrait;

    /** @var string Информация о роли пользователя */
    const ROLE = 'role';

    /** @var string Информация о группе пользователя */
    const GROUP = 'group';

    /** @var string amoJo ID пользователя */
    const AMOJO_ID = 'amojo_id';

    /** @var string UUID пользователя */
    const UUID = 'uuid';

    /**
     * @var int|null
     */
    protected $id;

    /**
     * @var string|null
     */
    protected $uuid;

    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var string|null
     */
    protected $amojoId;

    /**
     * @var string|null
     */
    protected $email;

    /**
     * @var string|null
     */
    protected $lang;

    /**
     * @var RightModel
     */
    protected $rights;

    /**
     * @var RolesCollection|null
     */
    protected $roles;

    /**
     * @var UsersGroupsCollection|null
     */
    protected $groups;

    /**
     * @var string|null
     */
    protected $password;

    /**
     * @param array $user
     *
     * @return self
     */
    public static function fromArray(array $user)
    {
        if (empty($user['id'])) {
            throw new InvalidArgumentException('User id is empty in ' . json_encode($user));
        }

        $model = new self();

        $model
            ->setId($user['id'])
            ->setName(isset($user['name']) ? $user['name'] : null)
            ->setEmail($user['email'])
            ->setLang(isset($user['lang']) ? $user['lang'] : null)
            ->setUuid(isset($user['uuid']) ? $user['uuid'] : null)
            ->setAmojoId(isset($user['amojo_id']) ? $user['amojo_id'] : null)
            ->setRights(RightModel::fromArray($user['rights']));

        $groupsCollection = new UsersGroupsCollection();
        if (!empty($user[AmoCRMApiRequest::EMBEDDED]['groups'])) {
            $groupsCollection = $groupsCollection->fromArray($user[AmoCRMApiRequest::EMBEDDED]['groups']);
        }
        $model->setGroups($groupsCollection);

        $rolesCollection = new RolesCollection();
        if (!empty($user[AmoCRMApiRequest::EMBEDDED][EntityTypesInterface::USER_ROLES])) {
            $rolesCollection = $rolesCollection->fromArray($user[AmoCRMApiRequest::EMBEDDED][EntityTypesInterface::USER_ROLES]);
        }
        $model->setRoles($rolesCollection);

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
            'email' => $this->getEmail(),
            'lang' => $this->getLang(),
            'uuid' => $this->getUuid(),
            'amojo_id' => $this->getAmojoId(),
            'rights' => $this->getRights()->toArray(),
            'roles' => is_null($this->getRoles()) ? null : $this->getRoles()->toArray(),
            'groups' => is_null($this->getGroups()) ? null : $this->getGroups()->toArray(),
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
     * @return UserModel
     */
    public function setId($id)
    {
        $this->id = $id;

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
     * @param string|null $uuid
     *
     * @return UserModel
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

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
     * @return UserModel
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return RightModel
     */
    public function getRights()
    {
        return $this->rights;
    }

    /**
     * @param RightModel $rights
     * @return UserModel
     */
    public function setRights(RightModel $rights)
    {
        $this->rights = $rights;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     *
     * @return UserModel
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * @param string|null $lang
     *
     * @return UserModel
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * @return RolesCollection|null
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param RolesCollection|null $roles
     *
     * @return UserModel
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return UsersGroupsCollection|null
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @param UsersGroupsCollection|null $groups
     *
     * @return UserModel
     */
    public function setGroups($groups)
    {
        $this->groups = $groups;

        return $this;
    }

    /**
     * @return null|string
     */
    protected function getPassword()
    {
        return $this->password;
    }

    /**
     * @param null|string $password
     *
     * @return UserModel
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAmojoId()
    {
        return $this->amojoId;
    }

    /**
     * @param string|null $amojoId
     *
     * @return UserModel
     */
    public function setAmojoId($amojoId)
    {
        $this->amojoId = $amojoId;

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

        if (!is_null($this->getEmail())) {
            $result['email'] = $this->getEmail();
        }

        if (!is_null($this->getEmail())) {
            $result['email'] = $this->getEmail();
        }

        if (!is_null($this->getPassword())) {
            $result['password'] = $this->getPassword();
        }

        if (!is_null($this->getRights())) {
            $result['rights'] = $this->getRights()->toUsersApi();
        }

        if (is_null($this->getRequestId()) && !is_null($requestId)) {
            $this->setRequestId($requestId);
        }

        $result['request_id'] = $this->getRequestId();

        return $result;
    }

    /**
     * @return array
     */
    public static function getAvailableWith()
    {
        return [
            self::ROLE,
            self::UUID,
            self::GROUP,
            self::AMOJO_ID,
        ];
    }
}

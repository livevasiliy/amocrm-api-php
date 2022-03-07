<?php

namespace AmoCRM\Models\Rights;

use AmoCRM\Helpers\EntityTypesInterface;
use AmoCRM\Models\BaseApiModel;

/**
 * Class RightModel
 *
 * @package AmoCRM\Models\Rights
 */
class RightModel extends BaseApiModel
{
    const RIGHTS_DENIED = 'D'; //D - Deny
    const RIGHTS_FULL = 'A'; //A - Allow
    const RIGHTS_GROUP = 'G'; //G - Group
    const RIGHTS_LINKED = 'L'; //L - Linked
    const RIGHTS_ONLY_RESPONSIBLE = 'M'; //M - Main

    const ACTION_ADD = 'add';
    const ACTION_EDIT = 'edit';
    const ACTION_VIEW = 'view';
    const ACTION_DELETE = 'delete';
    const ACTION_EXPORT = 'export';

    const ADD_PERMISSIONS = [
        self::RIGHTS_FULL,
        self::RIGHTS_DENIED,
    ];

    const TYPE_ACTIONS = [
        EntityTypesInterface::TASKS => [
            self::ACTION_EDIT,
            self::ACTION_DELETE,
        ],
        EntityTypesInterface::LEADS => [
            self::ACTION_VIEW,
            self::ACTION_EDIT,
            self::ACTION_ADD,
            self::ACTION_DELETE,
            self::ACTION_EXPORT,
        ],
        EntityTypesInterface::CONTACTS => [
            self::ACTION_VIEW,
            self::ACTION_EDIT,
            self::ACTION_ADD,
            self::ACTION_DELETE,
            self::ACTION_EXPORT,
        ],
        EntityTypesInterface::COMPANIES => [
            self::ACTION_VIEW,
            self::ACTION_EDIT,
            self::ACTION_ADD,
            self::ACTION_DELETE,
            self::ACTION_EXPORT,
        ],
        EntityTypesInterface::STATUS_RIGHTS => [
            self::ACTION_VIEW,
            self::ACTION_EDIT,
            self::ACTION_DELETE,
            self::ACTION_EXPORT,
        ],
        EntityTypesInterface::CATALOG_RIGHTS => [
            self::ACTION_VIEW,
            self::ACTION_ADD,
            self::ACTION_EDIT,
            self::ACTION_DELETE,
            self::ACTION_EXPORT,
        ]
    ];

    const TYPE_PERMISSIONS = [
        EntityTypesInterface::TASKS => [
            self::RIGHTS_FULL,
            self::RIGHTS_DENIED,
            self::RIGHTS_GROUP,
            self::RIGHTS_ONLY_RESPONSIBLE,
        ],
        EntityTypesInterface::LEADS => [
            self::RIGHTS_FULL,
            self::RIGHTS_DENIED,
            self::RIGHTS_GROUP,
            self::RIGHTS_ONLY_RESPONSIBLE,
        ],
        EntityTypesInterface::CONTACTS => [
            self::RIGHTS_FULL,
            self::RIGHTS_DENIED,
            self::RIGHTS_GROUP,
            self::RIGHTS_ONLY_RESPONSIBLE,
        ],
        EntityTypesInterface::COMPANIES => [
            self::RIGHTS_FULL,
            self::RIGHTS_DENIED,
            self::RIGHTS_GROUP,
            self::RIGHTS_ONLY_RESPONSIBLE,
        ],
        EntityTypesInterface::STATUS_RIGHTS => [
            self::RIGHTS_FULL,
            self::RIGHTS_DENIED,
        ],
        EntityTypesInterface::CATALOG_RIGHTS => [
            self::RIGHTS_FULL,
            self::RIGHTS_LINKED,
            self::RIGHTS_DENIED,
        ],
    ];

    const ACTION_DEPENDENCIES = [
        self::ACTION_ADD    => [],
        self::ACTION_VIEW   => [],
        self::ACTION_EDIT   => [self::ACTION_VIEW],
        self::ACTION_DELETE => [self::ACTION_VIEW, self::ACTION_EDIT],
        self::ACTION_EXPORT => [self::ACTION_VIEW],
    ];

    const PERMISSIONS_PRIORITY = [
        self::RIGHTS_FULL => 0,
        self::RIGHTS_LINKED => 1,
        self::RIGHTS_GROUP => 2,
        self::RIGHTS_ONLY_RESPONSIBLE => 3,
        self::RIGHTS_DENIED => 4,
    ];

    /**
     * @var array
     */
    protected $leadsRights;

    /**
     * @var array
     */
    protected $contactsRights;

    /**
     * @var array
     */
    protected $companiesRights;

    /**
     * @var array
     */
    protected $tasksRights;

    /**
     * @var bool
     */
    protected $mailAccess;

    /**
     * @var bool
     */
    protected $catalogAccess;

    /**
     * @var array
     */
    protected $statusRights;

    /**
     * @var array
     */
    protected $catalogRights;

    /**
     * @var int|null
     */
    protected $roleId;

    /**
     * @var bool|null
     */
    protected $isFree;

    /**
     * @var int|null
     */
    protected $groupId;

    /**
     * @var bool|null
     */
    protected $isAdmin;

    /**
     * @var bool|null
     */
    protected $isActive;

    /**
     * @return null|array
     */
    public function getLeadsRights()
    {
        return $this->leadsRights;
    }

    /**
     * @param array $leadsRights
     *
     * @return RightModel
     */
    public function setLeadsRights(array $leadsRights)
    {
        $this->leadsRights = $this->completeRightsDependencies($leadsRights, EntityTypesInterface::LEADS);

        return $this;
    }

    /**
     * @return null|array
     */
    public function getContactsRights()
    {
        return $this->contactsRights;
    }

    /**
     * @param array $contactsRights
     *
     * @return RightModel
     */
    public function setContactsRights(array $contactsRights)
    {
        $this->contactsRights = $this->completeRightsDependencies($contactsRights, EntityTypesInterface::CONTACTS);

        return $this;
    }

    /**
     * @return null|array
     */
    public function getCompaniesRights()
    {
        return $this->companiesRights;
    }

    /**
     * @param array $companiesRights
     *
     * @return RightModel
     */
    public function setCompaniesRights(array $companiesRights)
    {
        $this->companiesRights = $this->completeRightsDependencies($companiesRights, EntityTypesInterface::COMPANIES);

        return $this;
    }

    /**
     * @return null|array
     */
    public function getTasksRights()
    {
        return $this->tasksRights;
    }

    /**
     * @param array $tasksRights
     *
     * @return RightModel
     */
    public function setTasksRights(array $tasksRights)
    {
        $this->tasksRights = $this->completeRightsDependencies($tasksRights, EntityTypesInterface::TASKS);

        return $this;
    }

    /**
     * @return null|bool
     */
    public function getMailAccess()
    {
        return $this->mailAccess;
    }

    /**
     * @param bool $mailAccess
     *
     * @return RightModel
     */
    public function setMailAccess($mailAccess)
    {
        $this->mailAccess = $mailAccess;

        return $this;
    }

    /**
     * @return null|bool
     * @deprecated will be removed in next major version
     */
    public function getCatalogAccess()
    {
        return $this->catalogAccess;
    }

    /**
     * @param bool $catalogAccess
     *
     * @return RightModel
     * @deprecated will be removed in next major version
     */
    public function setCatalogAccess($catalogAccess)
    {
        $this->catalogAccess = $catalogAccess;

        return $this;
    }

    /**
     * @return null|array
     */
    public function getStatusRights()
    {
        return $this->statusRights;
    }

    public function getCatalogRights()
    {
        return $this->catalogRights;
    }

    /**
     * @param array $statusRights
     *
     * @return RightModel
     */
    public function setStatusRights(array $statusRights)
    {
        $result = [];

        foreach ($statusRights as $statusRight) {
            $result[] = [
                'entity_type' => isset($statusRight['entity_type']) ? $statusRight['entity_type'] : EntityTypesInterface::LEADS,
                'pipeline_id' => isset($statusRight['pipeline_id']) ? $statusRight['pipeline_id'] : null,
                'status_id' => isset($statusRight['status_id']) ? $statusRight['status_id'] : null,
                'rights' => $this->completeRightsDependencies($statusRight['rights'], EntityTypesInterface::STATUS_RIGHTS),
            ];
        }

        $this->statusRights = $result;

        return $this;
    }

    public function setCatalogRights(array $catalogRights)
    {
        $result = [];

        foreach ($catalogRights as $catalogRight) {
            $result[] = [
                'catalog_id' => isset($catalogRight['catalog_id']) ? $catalogRight['catalog_id'] : null,
                'rights'     => $this->completeRightsDependencies(
                    $catalogRight['rights'],
                    EntityTypesInterface::CATALOG_RIGHTS
                ),
            ];
        }

        $this->catalogRights = $result;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * @param int|null $roleId
     *
     * @return RightModel
     */
    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsFree()
    {
        return $this->isFree;
    }

    /**
     * @param bool|null $isFree
     *
     * @return RightModel
     */
    public function setIsFree($isFree)
    {
        $this->isFree = $isFree;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @param int|null $groupId
     *
     * @return RightModel
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * @param bool|null $isAdmin
     *
     * @return RightModel
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param bool|null $isActive
     *
     * @return RightModel
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @param array $rights
     *
     * @param string $entityType
     *
     * @return array
     */
    protected function completeRightsDependencies(array $rights, $entityType)
    {
        $finalRights = [];

        //Дополним то, чего не хватает
        foreach (self::TYPE_ACTIONS[$entityType] as $action) {
            if (!isset($rights[$action]) || !in_array($rights[$action], self::TYPE_PERMISSIONS[$entityType])) {
                if (!($entityType === EntityTypesInterface::STATUS_RIGHTS && $action === self::ACTION_EXPORT)) {
                    $finalRights[$action] = self::RIGHTS_DENIED;
                }
            } else {
                $finalRights[$action] = $rights[$action];
            }

            if ($action === self::ACTION_ADD) {
                if (!in_array($rights[$action], self::ADD_PERMISSIONS)) {
                    $finalRights[$action] = self::RIGHTS_DENIED;
                }
            }
        }

        //Уменьшаем завышенные права
        foreach (self::TYPE_ACTIONS[$entityType] as $action) {
            if (!empty(self::ACTION_DEPENDENCIES[$action]) && isset($finalRights[$action])) {
                $actionPriority = self::PERMISSIONS_PRIORITY[$finalRights[$action]];
                $dependencies = self::ACTION_DEPENDENCIES[$action];

                foreach ($dependencies as $dependency) {
                    if (!in_array($dependency, self::TYPE_ACTIONS[$entityType])) {
                        continue;
                    }

                    if (!isset($finalRights[$dependency])) {
                        $finalRights[$dependency] = self::RIGHTS_DENIED;
                    }

                    $dependencyPermission = $finalRights[$dependency];
                    $dependencyPriority = self::PERMISSIONS_PRIORITY[$dependencyPermission];

                    if ($actionPriority < $dependencyPriority) {
                        $actionPriority = $dependencyPriority;
                    }
                }

                $finalRights[$action] = array_flip(self::PERMISSIONS_PRIORITY)[$actionPriority];
            }
        }

        return $finalRights;
    }

    /**
     * @param array $rights
     *
     * @return self
     */
    public static function fromArray(array $rights)
    {
        $model = new self();

        $model
            ->setCatalogAccess($rights['catalog_access'])
            ->setMailAccess($rights['mail_access'])
            ->setLeadsRights($rights['leads'])
            ->setContactsRights($rights['contacts'])
            ->setCompaniesRights($rights['companies'])
            ->setTasksRights($rights['tasks'])
            ->setIsAdmin(isset($rights['is_admin']) ? $rights['is_admin'] : null)
            ->setIsFree(isset($rights['is_free']) ? $rights['is_free'] : null)
            ->setIsActive(isset($rights['is_active']) ? $rights['is_active'] : null)
            ->setRoleId(isset($rights['role_id']) ? $rights['role_id'] : null)
            ->setGroupId(isset($rights['group_id']) ? $rights['group_id'] : null);

        if (!empty($rights['status_rights'])) {
            $model->setStatusRights($rights['status_rights']);
        }

        if (!empty($rights['catalog_rights'])) {
            $model->setCatalogRights($rights['catalog_rights']);
        }

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        $result = [
            'leads' => $this->getLeadsRights(),
            'contacts' => $this->getContactsRights(),
            'companies' => $this->getCompaniesRights(),
            'tasks' => $this->getTasksRights(),
            'status_rights' => $this->getStatusRights(),
            'mail_access' => $this->getMailAccess(),
            'catalog_access' => $this->getCatalogAccess(),
            'catalog_rights' => $this->getCatalogRights(),
        ];

        if (!is_null($this->getRoleId())) {
            $result['role_id'] = $this->getRoleId();
        }

        if (!is_null($this->getIsFree())) {
            $result['is_free'] = $this->getIsFree();
        }

        if (!is_null($this->getGroupId())) {
            $result['group_id'] = $this->getGroupId();
        }

        if (!is_null($this->getIsAdmin())) {
            $result['is_admin'] = $this->getIsAdmin();
        }

        if (!is_null($this->getIsActive())) {
            $result['is_active'] = $this->getIsActive();
        }

        return $result;
    }

    public function toApi($requestId = "0")
    {
        $result = [
            'leads' => $this->getLeadsRights(),
            'contacts' => $this->getContactsRights(),
            'companies' => $this->getCompaniesRights(),
            'tasks' => $this->getTasksRights(),
            'status_rights' => $this->getStatusRights(),
            'mail_access' => $this->getMailAccess(),
            'catalog_rights' => $this->getCatalogRights(),
        ];

        if (($catalogAccess = $this->getCatalogAccess()) !== null) {
            $result['catalog_access'] = $catalogAccess;
        }

        return $result;
    }

    public function toUsersApi($requestId = null)
    {
        $result = $this->toApi($requestId);

        if (!is_null($this->getRoleId())) {
            $result = [
                'role_id' => $this->getRoleId(),
            ];
        }

        if (!is_null($this->getGroupId())) {
            $result['group_id'] = $this->getGroupId();
        }

        if (!is_null($this->getIsFree())) {
            $result = [
                'is_free' => $this->getIsFree(),
            ];
        }

        return $result;
    }
}

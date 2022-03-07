<?php

namespace AmoCRM\Models;

use AmoCRM\Client\AmoCRMApiRequest;
use AmoCRM\Collections\TaskTypesCollection;
use AmoCRM\Collections\UsersGroupsCollection;
use AmoCRM\Models\AccountSettings\AmojoRights;
use AmoCRM\Models\AccountSettings\DateTimeSettings;
use AmoCRM\Models\AccountSettings\InvoicesSettings;

class AccountModel extends BaseApiModel
{
    /** @var string ID аккаунта в сервисе чатов */
    const AMOJO_ID = 'amojo_id';
    /** @var string UUID аккаунта */
    const UUID = 'uuid';
    /** @var string Права на встроенные чаты */
    const AMOJO_RIGHTS = 'amojo_rights';
    /** @var string Группы пользователей */
    const USER_GROUPS = 'users_groups';
    /** @var string Типы задач */
    const TASK_TYPES = 'task_types';
    /** @var string Версия аккаунта */
    const VERSION = 'version';
    /** @var string Настройки форматов времени */
    const DATETIME_SETTINGS = 'datetime_settings';
    /** @var string Настройки для публичных счетов */
    const INVOICES_SETTINGS = 'invoices_settings';
    /** @var string Доступ к фильтрации */
    const IS_API_FILTER_ENABLED = 'is_api_filter_enabled';

    /** @var string Покупатели недоступны. */
    const CUSTOMERS_MODE_UNAVAILABLE = 'unavailable';
    /** @var string Покупатели выключены. */
    const CUSTOMERS_MODE_DISABLED = 'disabled';

    /**
     * Режим периодических покупок (когда статус покупателя зависит от кол-ва дней до следующего платежа)
     * и покупатель оказывается в определенном статусе при совершении покупки
     *
     * @var string
     */
    const CUSTOMERS_MODE_PERIODICITY = 'periodicity';

    /**
     * Статус, в котором находится покупатель, не зависит от даты следующей покупки
     *
     * @var string
     * @deprecated
     */
    const CUSTOMERS_MODE_DYNAMIC = 'dynamic';

    /**
     * Покупатели не имеют статусов, но разделены по сегментам по принципу:
     * каждый покупатель может входить в состав множества сегментов
     * каждый сегмент может иметь множество покупателей
     *
     * @var string
     */
    const SEGMENTS = 'segments';

    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /** @var int */
    protected $createdAt;

    /** @var int */
    protected $updatedAt;

    /** @var int */
    protected $updatedBy;

    /** @var int */
    protected $createdBy;

    /** @var string */
    protected $subdomain;

    /** @var string|null */
    protected $amojoId;

    /** @var string|null */
    protected $uuid;

    /** @var AmojoRights */
    protected $amojoRights;

    /** @var UsersGroupsCollection */
    protected $usersGroups;

    /** @var TaskTypesCollection */
    protected $taskTypes;

    /** @var int */
    protected $version;

    /** @var bool */
    protected $unsortedOn;

    /** @var int */
    protected $mobileFeatureVersion;

    /** @var string */
    protected $customersMode;

    /** @var bool */
    protected $lossReasonsEnabled;

    /** @var bool */
    protected $helpbotEnabled;

    /** @var int */
    protected $contactNameDisplayOrder;

    /** @var DateTimeSettings */
    protected $datetimeSettings;

    /** @var int */
    protected $currentUserId;

    /** @var string|null */
    protected $country;

    /** @var string|null */
    protected $currency;

    /** @var string|null */
    protected $currencySymbol;

    /** @var bool */
    protected $isTechnicalAccount;

    /** @var null|InvoicesSettings */
    protected $invoicesSettings;

    /** @var bool */
    protected $isApiFilterEnabled;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return self
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
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }


    /**
     * @return null|int
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param null|int $userId
     *
     * @return self
     */
    public function setCreatedBy($userId)
    {
        $this->createdBy = $userId;

        return $this;
    }

    /**
     * @return null|int
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * @param null|int $userId
     *
     * @return self
     */
    public function setUpdatedBy($userId)
    {
        $this->updatedBy = $userId;

        return $this;
    }

    /**
     * @return int
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param int $timestamp
     *
     * @return self
     */
    public function setCreatedAt($timestamp)
    {
        $this->createdAt = $timestamp;

        return $this;
    }

    /**
     * @return int
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param int $timestamp
     *
     * @return self
     */
    public function setUpdatedAt($timestamp)
    {
        $this->updatedAt = $timestamp;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubdomain()
    {
        return $this->subdomain;
    }

    /**
     * @param string $subdomain
     * @return $this
     */
    public function setSubdomain($subdomain)
    {
        $this->subdomain = $subdomain;

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
     * @param string|null $id
     * @return $this
     */
    public function setAmojoId($id)
    {
        $this->amojoId = $id;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsApiFilterEnabled()
    {
        return $this->isApiFilterEnabled;
    }

    /**
     * @param bool $is_enabled
     * @return $this
     */
    public function setIsApiFilterEnabled($is_enabled)
    {
        $this->isApiFilterEnabled = $is_enabled;

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
     * @param string|null $id
     * @return $this
     */
    public function setUuid($id)
    {
        $this->uuid = $id;

        return $this;
    }

    /**
     * @param array $account
     * @return static
     */
    public static function fromArray(array $account)
    {
        $accountModel = new self();
        $accountModel->setId((int)$account['id'])
            ->setName($account['name'])
            ->setSubdomain($account['subdomain'])
            ->setCreatedBy((int)$account['created_by'])
            ->setCreatedAt($account['created_at'])
            ->setUpdatedBy((int)$account['updated_by'])
            ->setUpdatedAt($account['updated_at'])
            ->setCurrentUserId((int)$account['current_user_id'])
            ->setCountry((string)$account['country'])
            ->setCurrency((string)$account['currency'])
            ->setCurrencySymbol((string)(isset($account['currency_symbol']) ? $account['currency_symbol'] : null) ?: null)
            ->setUnsortedOn((bool)$account['is_unsorted_on'])
            ->setMobileFeatureVersion((int)$account['mobile_feature_version'])
            ->setCustomersMode($account['customers_mode'])
            ->setLossReasonsEnabled((bool)$account['is_loss_reason_enabled'])
            ->setHelpbotEnabled((bool)$account['is_helpbot_enabled'])
            ->setIsTechnicalAccount((bool)$account['is_technical_account'])
            ->setContactNameDisplayOrder((int)$account['contact_name_display_order']);

        if (isset($account[self::AMOJO_ID])) {
            $accountModel->setAmojoId($account[self::AMOJO_ID]);
        }

        if (isset($account[self::VERSION])) {
            $accountModel->setVersion($account[self::VERSION]);
        }

        if (isset($account[self::UUID])) {
            $accountModel->setUuid($account[self::UUID]);
        }

        if (isset($account[AmoCRMApiRequest::EMBEDDED][self::AMOJO_RIGHTS])) {
            $accountModel->setAmojoRights(new AmojoRights(
                $account[AmoCRMApiRequest::EMBEDDED][self::AMOJO_RIGHTS]['can_direct'],
                $account[AmoCRMApiRequest::EMBEDDED][self::AMOJO_RIGHTS]['can_create_groups']
            ));
        }

        if (isset($account[AmoCRMApiRequest::EMBEDDED][self::DATETIME_SETTINGS])) {
            $dateTimeSettings = $account[AmoCRMApiRequest::EMBEDDED][self::DATETIME_SETTINGS];

            $accountModel->setDatetimeSettings(new DateTimeSettings(
                $dateTimeSettings['date_pattern'],
                $dateTimeSettings['short_date_pattern'],
                $dateTimeSettings['short_time_pattern'],
                $dateTimeSettings['date_format'],
                $dateTimeSettings['time_format'],
                $dateTimeSettings['timezone'],
                $dateTimeSettings['timezone_offset']
            ));
        }

        if (isset($account[AmoCRMApiRequest::EMBEDDED][self::USER_GROUPS])) {
            $userGroups = $account[AmoCRMApiRequest::EMBEDDED][self::USER_GROUPS];
            $collection = new UsersGroupsCollection();
            $collection = $collection->fromArray($userGroups);
            $accountModel->setUsersGroups($collection);
        }

        if (isset($account[AmoCRMApiRequest::EMBEDDED][self::TASK_TYPES])) {
            $taskTypes = $account[AmoCRMApiRequest::EMBEDDED][self::TASK_TYPES];
            $collection = new TaskTypesCollection();
            $collection = $collection->fromArray($taskTypes);
            $accountModel->setTaskTypes($collection);
        }

        if (isset($account[self::INVOICES_SETTINGS])) {
            $accountModel->setInvoicesSettings(new InvoicesSettings(
                isset($account[self::INVOICES_SETTINGS]['lang']) ? $account[self::INVOICES_SETTINGS]['lang'] : null
            ));
        }

        if (isset($account[self::IS_API_FILTER_ENABLED])) {
            $accountModel->setIsApiFilterEnabled($account[self::IS_API_FILTER_ENABLED]);
        }

        return $accountModel;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        $result = [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'subdomain' => $this->getSubdomain(),
            'created_at' => $this->getCreatedAt(),
            'created_by' => $this->getCreatedBy(),
            'updated_at' => $this->getUpdatedAt(),
            'updated_by' => $this->getUpdatedBy(),
            'current_user_id' => $this->getCurrentUserId(),
            'country' => $this->getCountry(),
            'currency' => $this->getCurrency(),
            'currency_symbol' => $this->getCurrencySymbol(),
            'is_unsorted_on' => $this->getIsUnsortedOn(),
            'mobile_feature_version' => $this->getMobileFeatureVersion(),
            'customers_mode' => $this->getCustomersMode(),
            'is_loss_reason_enabled' => $this->getIsLossReasonsEnabled(),
            'is_helpbot_enabled' => $this->getIsHelpbotEnabled(),
            'contact_name_display_order' => $this->getContactNameDisplayOrder(),
            'is_technical_account' => $this->getIsTechnicalAccount(),
        ];

        if (!is_null($this->getAmojoId())) {
            $result['amojo_id'] = $this->getAmojoId();
        }

        if (!is_null($this->getUuid())) {
            $result['uuid'] = $this->getUuid();
        }

        if (!is_null($this->getAmojoRights())) {
            $result['amojo_rights'] = $this->getAmojoRights()->toArray();
        }

        if ($this->getUsersGroups() && !$this->getUsersGroups()->isEmpty()) {
            $result['users_groups'] = $this->getUsersGroups();
        }

        if ($this->getTaskTypes() && !$this->getTaskTypes()->isEmpty()) {
            $result['task_types'] = $this->getTaskTypes();
        }

        if (!is_null($this->getVersion())) {
            $result['version'] = $this->getVersion();
        }

        if (!is_null($this->getDatetimeSettings())) {
            $result['datetime_settings'] = $this->getDatetimeSettings();
        }

        if (!is_null($this->getInvoicesSettings())) {
            $result['invoices_settings'] = $this->getInvoicesSettings();
        }

        if (!is_null($this->getIsApiFilterEnabled())) {
            $result['is_api_filter_enabled'] = $this->getIsApiFilterEnabled();
        }

        return $result;
    }

    /**
     * @return string
     */
    public function getCustomersMode()
    {
        return $this->customersMode;
    }

    /**
     * @param string $customersMode
     *
     * @return AccountModel
     */
    public function setCustomersMode($customersMode)
    {
        $this->customersMode = $customersMode;

        return $this;
    }

    /**
     * @return AmojoRights|null
     */
    public function getAmojoRights()
    {
        return $this->amojoRights;
    }

    /**
     * @param AmojoRights $amojoRights
     * @return $this
     */
    public function setAmojoRights(AmojoRights $amojoRights)
    {
        $this->amojoRights = $amojoRights;

        return $this;
    }

    /**
     * @return UsersGroupsCollection
     */
    public function getUsersGroups()
    {
        return $this->usersGroups;
    }

    /**
     * @param UsersGroupsCollection $usersGroups
     * @return $this
     */
    public function setUsersGroups(UsersGroupsCollection $usersGroups)
    {
        $this->usersGroups = $usersGroups;

        return $this;
    }

    /**
     * @return TaskTypesCollection
     */
    public function getTaskTypes()
    {
        return $this->taskTypes;
    }

    /**
     * @param TaskTypesCollection $taskTypes
     * @return AccountModel
     */
    public function setTaskTypes(TaskTypesCollection $taskTypes)
    {
        $this->taskTypes = $taskTypes;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param int $version
     * @return AccountModel
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return bool
     */
    public function getIsUnsortedOn()
    {
        return $this->unsortedOn;
    }

    /**
     * @param bool $unsortedOn
     * @return AccountModel
     */
    public function setUnsortedOn($unsortedOn)
    {
        $this->unsortedOn = $unsortedOn;

        return $this;
    }

    /**
     * @return int
     */
    public function getMobileFeatureVersion()
    {
        return $this->mobileFeatureVersion;
    }

    /**
     * @param int $mobileFeatureVersion
     * @return AccountModel
     */
    public function setMobileFeatureVersion($mobileFeatureVersion)
    {
        $this->mobileFeatureVersion = $mobileFeatureVersion;

        return $this;
    }

    /**
     * @return bool
     */
    public function getIsLossReasonsEnabled()
    {
        return $this->lossReasonsEnabled;
    }

    /**
     * @param bool $lossReasonsEnabled
     * @return AccountModel
     */
    public function setLossReasonsEnabled($lossReasonsEnabled)
    {
        $this->lossReasonsEnabled = $lossReasonsEnabled;

        return $this;
    }

    /**
     * @return bool
     */
    public function getIsHelpbotEnabled()
    {
        return $this->helpbotEnabled;
    }

    /**
     * @param bool $helpbotEnabled
     * @return AccountModel
     */
    public function setHelpbotEnabled($helpbotEnabled)
    {
        $this->helpbotEnabled = $helpbotEnabled;

        return $this;
    }

    /**
     * @return int
     */
    public function getContactNameDisplayOrder()
    {
        return $this->contactNameDisplayOrder;
    }

    /**
     * @param int $contactNameDisplayOrder
     * @return AccountModel
     */
    public function setContactNameDisplayOrder($contactNameDisplayOrder)
    {
        $this->contactNameDisplayOrder = $contactNameDisplayOrder;

        return $this;
    }

    /**
     * @return DateTimeSettings|null
     */
    public function getDatetimeSettings()
    {
        return $this->datetimeSettings;
    }

    /**
     * @param DateTimeSettings $datetimeSettings
     * @return AccountModel
     */
    public function setDatetimeSettings(DateTimeSettings $datetimeSettings)
    {
        $this->datetimeSettings = $datetimeSettings;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCurrentUserId()
    {
        return $this->currentUserId;
    }

    /**
     * @param int $currentUserId
     * @return AccountModel
     */
    public function setCurrentUserId($currentUserId)
    {
        $this->currentUserId = $currentUserId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string|null $country
     * @return AccountModel
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string|null $currency
     *
     * @return AccountModel
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCurrencySymbol()
    {
        return $this->currencySymbol;
    }

    /**
     * @param string|null $currencySymbol
     *
     * @return AccountModel
     */
    public function setCurrencySymbol($currencySymbol)
    {
        $this->currencySymbol = $currencySymbol;

        return $this;
    }

    /**
     * @return null|InvoicesSettings
     */
    public function getInvoicesSettings()
    {
        return $this->invoicesSettings;
    }

    /**
     * @param InvoicesSettings $invoicesSettings
     * @return $this
     */
    public function setInvoicesSettings(InvoicesSettings $invoicesSettings)
    {
        $this->invoicesSettings = $invoicesSettings;

        return $this;
    }

    /**
     * @return bool
     */
    public function getIsTechnicalAccount()
    {
        return $this->isTechnicalAccount;
    }

    /**
     * @param bool $isTechnicalAccount
     *
     * @return AccountModel
     */
    public function setIsTechnicalAccount($isTechnicalAccount)
    {
        $this->isTechnicalAccount = $isTechnicalAccount;

        return $this;
    }

    /**
     * @return array
     */
    public static function getAvailableWith()
    {
        return [
            self::AMOJO_ID,
            self::UUID,
            self::AMOJO_RIGHTS,
            self::USER_GROUPS,
            self::TASK_TYPES,
            self::VERSION,
            self::DATETIME_SETTINGS,
            self::INVOICES_SETTINGS,
            self::IS_API_FILTER_ENABLED
        ];
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

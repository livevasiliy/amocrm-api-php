<?php

namespace AmoCRM\Models\CustomFields;

use AmoCRM\Collections\CustomFields\CustomFieldRequiredStatusesCollection;
use AmoCRM\Helpers\EntityTypesInterface;
use AmoCRM\Models\BaseApiModel;
use AmoCRM\Models\Interfaces\HasIdInterface;
use AmoCRM\Models\Traits\RequestIdTrait;
use InvalidArgumentException;

use function array_key_exists;
use function is_numeric;

/**
 * Class CustomFieldModel
 *
 * @package AmoCRM\Models\CustomFields
 */
class CustomFieldModel extends BaseApiModel implements HasIdInterface
{
    use RequestIdTrait;

    const TYPE_TEXT = 'text';
    const TYPE_NUMERIC = 'numeric';
    const TYPE_CHECKBOX = 'checkbox';
    const TYPE_SELECT = 'select';
    const TYPE_MULTISELECT = 'multiselect';
    const TYPE_MULTITEXT = 'multitext';
    const TYPE_DATE = 'date';
    const TYPE_URL = 'url';
    const TYPE_TEXTAREA = 'textarea';
    const TYPE_RADIOBUTTON = 'radiobutton';
    const TYPE_STREET_ADDRESS = 'streetaddress';
    const TYPE_SMART_ADDRESS = 'smart_address';
    const TYPE_BIRTHDAY = 'birthday';
    const TYPE_LEGAL_ENTITY = 'legal_entity';
    const TYPE_DATE_TIME = 'date_time';
    const TYPE_ITEMS = 'items';
    const TYPE_CATEGORY = 'category';
    const TYPE_PRICE = 'price';
    const TYPE_TRACKING_DATA = 'tracking_data';
    const TYPE_LINKED_ENTITY = 'linked_entity';
    /** @deprecated */
    const TYPE_ORG_LEGAL_NAME = 'org_legal_name';

    const CAN_HAVE_REQUIRED_STATUSES = [
        EntityTypesInterface::LEADS,
        EntityTypesInterface::CONTACTS,
        EntityTypesInterface::COMPANIES,
    ];

    const CAN_HAVE_SEARCH_IN = [
        self::TYPE_LINKED_ENTITY,
    ];

    const CAN_BE_API_ONLY = [
        EntityTypesInterface::LEADS,
        EntityTypesInterface::CONTACTS,
        EntityTypesInterface::COMPANIES,
        EntityTypesInterface::CUSTOMERS,
    ];

    const CAN_BE_IS_DELETABLE = [
        EntityTypesInterface::CATALOGS,
    ];

    const CAN_BE_IS_VISIBLE = [
        EntityTypesInterface::CATALOGS,
    ];

    const CAN_BE_IS_REQUIRED = [
        EntityTypesInterface::CATALOGS,
    ];

    const CAN_BE_SEARCHED_IN = [
        EntityTypesInterface::CONTACTS,
        EntityTypesInterface::COMPANIES,
        EntityTypesInterface::CONTACTS_AND_COMPANIES,
    ];

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var null|string
     */
    protected $groupId;

    /**
     * @var int|null
     */
    protected $sort;

    /**
     * All without segments and catalog
     * @var null|bool
     */
    protected $isApiOnly;

    /**
     * Catalog only
     * @var null|bool
     */
    protected $isDeletable;

    /**
     * Catalog only
     * @var null|bool
     */
    protected $isVisible;

    /**
     * Catalog only
     * @var null|bool
     */
    protected $isRequired;

    /**
     * Catalog only
     * @var null|int
     */
    protected $catalogId;

    /**
     * Company|Contact only
     * @var bool|int
     */
    protected $isPredefined;

    /**
     * @var null|CustomFieldRequiredStatusesCollection
     */
    protected $requiredStatuses;

    /**
     * @var string|null
     */
    protected $code;

    /**
     * @var int
     */
    protected $accountId;

    /**
     * @var string
     */
    protected $entityType;

    /**
     * @var null|string
     */
    protected $trackingCallback;

    /**
     * Используется в интерфейсе счета для предложения результатов быстрого поиска
     * Указывается сущность (contacts, companies или ID каталога), по которой делаем быстрый поиск из карточки счета
     * @var null|string
     */
    protected $searchIn;

    /**
     * @param array $customField
     *
     * @return CustomFieldModel
     */
    public static function fromArray(array $customField)
    {
        if (empty($customField['id'])) {
            throw new InvalidArgumentException('Custom field id is empty in ' . json_encode($customField));
        }

        $customFieldModel = new static();

        $customFieldModel
            ->setId($customField['id'])
            ->setName($customField['name'])
            ->setSort($customField['sort'])
            ->setCode(empty($customField['code']) ? null : $customField['code'])
            ->setEntityType($customField['entity_type'])
            ->setAccountId($customField['account_id']);

        if (!empty($customField['group_id'])) {
            $customFieldModel->setGroupId($customField['group_id']);
        }

        if (!empty($customField['required_statuses'])) {
            $customFieldModel->setRequiredStatuses(
                CustomFieldRequiredStatusesCollection::fromArray($customField['required_statuses'])
            );
        }

        if (array_key_exists('is_api_only', $customField)) {
            $customFieldModel->setIsApiOnly($customField['is_api_only']);
        }

        if (array_key_exists('is_deletable', $customField)) {
            $customFieldModel->setIsDeletable($customField['is_deletable']);
        }

        if (array_key_exists('is_required', $customField)) {
            $customFieldModel->setIsRequired($customField['is_required']);
        }

        if (array_key_exists('is_visible', $customField)) {
            $customFieldModel->setIsVisible($customField['is_visible']);
        }

        if (array_key_exists('catalog_id', $customField)) {
            $customFieldModel->setCatalogId($customField['catalog_id']);
        }

        if (array_key_exists('is_predefined', $customField)) {
            $customFieldModel->setIsPredefined($customField['is_predefined']);
        }

        if (array_key_exists('tracking_callback', $customField)) {
            $customFieldModel->setTrackingCallback($customField['tracking_callback']);
        }

        if (array_key_exists('search_in', $customField)) {
            $customFieldModel->setSearchIn($customField['search_in']);
        }

        return $customFieldModel;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'sort' => $this->getSort(),
            'type' => $this->getType(),
            'is_api_only' => $this->getIsApiOnly(),
            'code' => $this->getCode(),
            'group_id' => $this->getGroupId(),
            'entity_type' => $this->getEntityType(),
            'required_statuses' => $this->getRequiredStatuses(),
            'tracking_callback' => $this->getTrackingCallback(),
            'search_in' => $this->getSearchIn(),
            'account_id' => $this->getAccountId(),
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
     * @return CustomFieldModel
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return CustomFieldModel
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return null|int
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @param int $sort
     * @return CustomFieldModel
     */
    public function setSort($sort)
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * @param string|null $requestId
     * @return array
     */
    public function toApi($requestId = "0")
    {
        $result = [
            'type' => $this->getType(),
        ];

        if (!is_null($this->getId())) {
            $result['id'] = $this->getId();
        }

        if (!is_null($this->getName())) {
            $result['name'] = $this->getName();
        }

        if (!is_null($this->getCode())) {
            $result['code'] = $this->getCode();
        }

        if (!is_null($this->getSort())) {
            $result['sort'] = $this->getSort();
        }

        if (!is_null($this->getGroupId())) {
            $result['group_id'] = $this->getGroupId();
        }

        if (
            !is_null($this->getIsApiOnly())
            && in_array($this->getEntityType(), self::CAN_BE_API_ONLY, true)
        ) {
            $result['is_api_only'] = $this->getIsApiOnly();
        }

        if (
            !is_null($this->getRequiredStatuses())
            && in_array($this->getEntityType(), self::CAN_HAVE_REQUIRED_STATUSES, true)
        ) {
            $result['required_statuses'] = $this->getRequiredStatuses();
        }

        if (
            !is_null($this->getIsDeletable())
            && in_array($this->getEntityType(), self::CAN_BE_IS_DELETABLE, true)
        ) {
            $result['is_deletable'] = $this->getIsDeletable();
        }

        if (
            !is_null($this->getIsRequired())
            && in_array($this->getEntityType(), self::CAN_BE_IS_REQUIRED, true)
        ) {
            $result['is_required'] = $this->getIsRequired();
        }

        if (
            !is_null($this->getIsVisible())
            && in_array($this->getEntityType(), self::CAN_BE_IS_VISIBLE, true)
        ) {
            $result['is_visible'] = $this->getIsVisible();
        }

        if (
            !is_null($this->getSearchIn())
            && (
                in_array($this->getSearchIn(), self::CAN_BE_SEARCHED_IN, true)
                || is_numeric($this->getSearchIn())
            )
            && in_array($this->getType(), self::CAN_HAVE_SEARCH_IN, true)
        ) {
            $result['search_in'] = $this->getSearchIn();
        }

        if (is_null($this->getRequestId()) && !is_null($requestId)) {
            $this->setRequestId($requestId);
        }

        $result['request_id'] = $this->getRequestId();

        return $result;
    }

    /**
     * @return null|string
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @param null|string $groupId
     * @return CustomFieldModel
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return '';
    }

    /**
     * @return null|bool
     */
    public function getIsApiOnly()
    {
        return $this->isApiOnly;
    }

    /**
     * @param bool $isApiOnly
     * @return CustomFieldModel
     */
    public function setIsApiOnly($isApiOnly)
    {
        if ($isApiOnly) {
            $this->setRequiredStatuses(null);
        }
        $this->isApiOnly = $isApiOnly;

        return $this;
    }

    /**
     * @return null|CustomFieldRequiredStatusesCollection
     */
    public function getRequiredStatuses()
    {
        return $this->requiredStatuses;
    }

    /**
     * @param null|CustomFieldRequiredStatusesCollection $requiredStatuses
     * @return CustomFieldModel
     */
    public function setRequiredStatuses($requiredStatuses)
    {
        $this->requiredStatuses = $requiredStatuses;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string|null $code
     *
     * @return CustomFieldModel
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return null|int
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @param int $accountId
     *
     * @return CustomFieldModel
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;

        return $this;
    }

    /**
     * @return string
     */
    public function getEntityType()
    {
        return $this->entityType;
    }

    /**
     * @param string $entityType
     *
     * @return CustomFieldModel
     */
    public function setEntityType($entityType)
    {
        $this->entityType = $entityType;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsDeletable()
    {
        return $this->isDeletable;
    }

    /**
     * @param bool|null $isDeletable
     *
     * @return CustomFieldModel
     */
    public function setIsDeletable($isDeletable)
    {
        $this->isDeletable = $isDeletable;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsVisible()
    {
        return $this->isVisible;
    }

    /**
     * @param bool|null $isVisible
     *
     * @return CustomFieldModel
     */
    public function setIsVisible($isVisible)
    {
        $this->isVisible = $isVisible;

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
     * @return CustomFieldModel
     */
    public function setIsRequired($isRequired)
    {
        $this->isRequired = $isRequired;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCatalogId()
    {
        return $this->catalogId;
    }

    /**
     * @param int|null $catalogId
     *
     * @return CustomFieldModel
     */
    public function setCatalogId($catalogId)
    {
        $this->catalogId = $catalogId;

        return $this;
    }

    /**
     * @return bool|int
     */
    public function getIsPredefined()
    {
        return $this->isPredefined;
    }

    /**
     * @param bool|int $isPredefined
     *
     * @return CustomFieldModel
     */
    public function setIsPredefined($isPredefined)
    {
        $this->isPredefined = $isPredefined;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTrackingCallback()
    {
        return $this->trackingCallback;
    }

    /**
     * @param string|null $trackingCallback
     *
     * @return CustomFieldModel
     */
    public function setTrackingCallback($trackingCallback)
    {
        $this->trackingCallback = $trackingCallback;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSearchIn()
    {
        return $this->searchIn;
    }

    /**
     * @param string|null $searchIn
     *
     * @return CustomFieldModel
     */
    public function setSearchIn($searchIn)
    {
        $this->searchIn = $searchIn;

        return $this;
    }
}

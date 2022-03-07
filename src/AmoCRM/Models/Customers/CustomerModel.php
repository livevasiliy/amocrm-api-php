<?php

namespace AmoCRM\Models\Customers;

use AmoCRM\Exceptions\InvalidArgumentException;
use AmoCRM\Helpers\EntityTypesInterface;
use AmoCRM\Models\Interfaces\CanBeLinkedInterface;
use AmoCRM\Models\Interfaces\HasIdInterface;
use AmoCRM\Models\Traits\GetLinkTrait;
use AmoCRM\Models\Traits\RequestIdTrait;
use AmoCRM\Models\Interfaces\TypeAwareInterface;
use AmoCRM\Client\AmoCRMApiRequest;
use AmoCRM\Collections\CatalogElementsCollection;
use AmoCRM\Collections\ContactsCollection;
use AmoCRM\Collections\CustomFieldsValuesCollection;
use AmoCRM\Collections\Customers\Segments\SegmentsCollection;
use AmoCRM\Collections\TagsCollection;
use AmoCRM\Models\BaseApiModel;
use AmoCRM\Models\CompanyModel;

use function is_null;
use function array_key_exists;

/**
 * Class CustomerModel
 *
 * @package AmoCRM\Models\Customers
 */
class CustomerModel extends BaseApiModel implements TypeAwareInterface, CanBeLinkedInterface, HasIdInterface
{
    use GetLinkTrait;
    use RequestIdTrait;

    const CATALOG_ELEMENTS = 'catalog_elements';
    const CONTACTS = 'contacts';
    const COMPANIES = 'companies';

    /**
     * @var int
     */
    protected $id;

    /**
     * @var null|string
     */
    protected $name;

    /**
     * @var int|null
     */
    protected $nextPrice;

    /**
     * @var int|null
     */
    protected $nextDate;

    /**
     * @var int
     */
    protected $responsibleUserId;

    /**
     * @var int
     */
    protected $createdBy;

    /**
     * @var int
     */
    protected $updatedBy;

    /**
     * @var int
     */
    protected $createdAt;

    /**
     * @var int
     */
    protected $updatedAt;

    /**
     * @var int
     */
    protected $accountId;

    /**
     * @var int|null
     */
    protected $statusId;

    /**
     * @var int|null
     */
    protected $periodicity;

    /**
     * @var int
     */
    protected $closestTaskAt;

    /**
     * @var int|null
     */
    protected $ltv;

    /**
     * @var int|null
     */
    protected $purchasesCount;

    /**
     * @var int|null
     */
    protected $averageCheck;

    /**
     * @var SegmentsCollection|null
     */
    protected $segments;

    /**
     * @var bool
     */
    protected $isDeleted;

    /**
     * @var null|TagsCollection
     */
    protected $tags;

    /**
     * @var CustomFieldsValuesCollection|null
     */
    protected $customFieldsValues;

    /**
     * @var ContactsCollection|null
     */
    protected $contacts = null;

    /**
     * @var CompanyModel|null
     */
    protected $company = null;

    /**
     * @var CatalogElementsCollection|null
     */
    protected $catalogElementsLinks = null;

    /**
     * @return string
     */
    public function getType()
    {
        return EntityTypesInterface::CUSTOMERS;
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
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return null|string
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
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @param int $id
     *
     * @return self
     */
    public function setAccountId($id)
    {
        $this->accountId = $id;

        return $this;
    }

    /**
     * @return null|int
     */
    public function getResponsibleUserId()
    {
        return $this->responsibleUserId;
    }

    /**
     * @param int $userId
     *
     * @return self
     */
    public function setResponsibleUserId($userId)
    {
        $this->responsibleUserId = $userId;

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
     * @param int $userId
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
     * @param int $userId
     *
     * @return self
     */
    public function setUpdatedBy($userId)
    {
        $this->updatedBy = $userId;

        return $this;
    }

    /**
     * @return null|int
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
     * @return null|int
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
     * @return null|int
     */
    public function getStatusId()
    {
        return $this->statusId;
    }

    /**
     * @param int $statusId
     *
     * @return self
     */
    public function setStatusId($statusId)
    {
        $this->statusId = $statusId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getClosestTaskAt()
    {
        return $this->closestTaskAt;
    }

    /**
     * @param int|null $timestamp
     *
     * @return self
     */
    public function setClosestTaskAt($timestamp)
    {
        $this->closestTaskAt = $timestamp;

        return $this;
    }

    /**
     * @return null|bool
     */
    public function getIsDeleted()
    {
        return $this->isDeleted;
    }

    /**
     * @param bool $flag
     *
     * @return self
     */
    public function setIsDeleted($flag)
    {
        $this->isDeleted = $flag;

        return $this;
    }

    /**
     * @return null|TagsCollection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param null|TagsCollection $tags
     *
     * @return self
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * @return null|CompanyModel
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param CompanyModel $company
     *
     * @return self
     */
    public function setCompany(CompanyModel $company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return CustomFieldsValuesCollection|null
     */
    public function getCustomFieldsValues()
    {
        return $this->customFieldsValues;
    }

    /**
     * @param CustomFieldsValuesCollection|null $values
     *
     * @return self
     */
    public function setCustomFieldsValues($values)
    {
        $this->customFieldsValues = $values;

        return $this;
    }

    /**
     * @return ContactsCollection|null
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * @param ContactsCollection $contacts
     *
     * @return self
     */
    public function setContacts(ContactsCollection $contacts)
    {
        $this->contacts = $contacts;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getNextPrice()
    {
        return $this->nextPrice;
    }

    /**
     * @param int|null $nextPrice
     *
     * @return CustomerModel
     */
    public function setNextPrice($nextPrice)
    {
        $this->nextPrice = $nextPrice;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getNextDate()
    {
        return $this->nextDate;
    }

    /**
     * @param int|null $nextDate
     *
     * @return CustomerModel
     */
    public function setNextDate($nextDate)
    {
        $this->nextDate = $nextDate;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPeriodicity()
    {
        return $this->periodicity;
    }

    /**
     * @param int|null $periodicity
     *
     * @return CustomerModel
     */
    public function setPeriodicity($periodicity)
    {
        $this->periodicity = $periodicity;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getLtv()
    {
        return $this->ltv;
    }

    /**
     * @param int|null $ltv
     *
     * @return CustomerModel
     */
    public function setLtv($ltv)
    {
        $this->ltv = $ltv;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPurchasesCount()
    {
        return $this->purchasesCount;
    }

    /**
     * @param int|null $purchasesCount
     *
     * @return CustomerModel
     */
    public function setPurchasesCount($purchasesCount)
    {
        $this->purchasesCount = $purchasesCount;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getAverageCheck()
    {
        return $this->averageCheck;
    }

    /**
     * @param int|null $averageCheck
     *
     * @return CustomerModel
     */
    public function setAverageCheck($averageCheck)
    {
        $this->averageCheck = $averageCheck;

        return $this;
    }

    /**
     * @return SegmentsCollection|null
     */
    public function getSegments()
    {
        return $this->segments;
    }

    /**
     * @param SegmentsCollection|null $segments
     *
     * @return CustomerModel
     */
    public function setSegments($segments)
    {
        $this->segments = $segments;

        return $this;
    }


    /**
     * @param array $customer
     *
     * @return self
     * @throws InvalidArgumentException
     */
    public static function fromArray(array $customer)
    {
        if (empty($customer['id'])) {
            throw new InvalidArgumentException('Customer id is empty in ' . json_encode($customer));
        }

        $customerModel = new self();

        $customerModel->setId((int)$customer['id']);

        if (!empty($customer['name'])) {
            $customerModel->setName($customer['name']);
        }
        if (array_key_exists('next_price', $customer) && !is_null($customer['next_price'])) {
            $customerModel->setNextPrice((int)$customer['next_price']);
        }
        if (array_key_exists('next_date', $customer) && !is_null($customer['next_date'])) {
            $customerModel->setNextDate((int)$customer['next_date']);
        }
        if (array_key_exists('responsible_user_id', $customer) && !is_null($customer['responsible_user_id'])) {
            $customerModel->setResponsibleUserId((int)$customer['responsible_user_id']);
        }
        if (!empty($customer['status_id'])) {
            $customerModel->setStatusId((int)$customer['status_id']);
        }
        if (array_key_exists('periodicity', $customer) && !is_null($customer['periodicity'])) {
            $customerModel->setPeriodicity((int)$customer['periodicity']);
        }
        if (array_key_exists('ltv', $customer) && !is_null($customer['ltv'])) {
            $customerModel->setLtv((int)$customer['ltv']);
        }
        if (array_key_exists('purchases_count', $customer) && !is_null($customer['purchases_count'])) {
            $customerModel->setPeriodicity((int)$customer['purchases_count']);
        }
        if (array_key_exists('average_check', $customer) && !is_null($customer['average_check'])) {
            $customerModel->setPeriodicity((int)$customer['average_check']);
        }
        if (!empty($customer['custom_fields_values'])) {
            $valuesCollection = new CustomFieldsValuesCollection();
            $customFieldsValues = $valuesCollection->fromArray($customer['custom_fields_values']);
            $customerModel->setCustomFieldsValues($customFieldsValues);
        }
        if (array_key_exists('created_by', $customer) && !is_null($customer['created_by'])) {
            $customerModel->setCreatedBy((int)$customer['created_by']);
        }
        if (array_key_exists('updated_by', $customer) && !is_null($customer['updated_by'])) {
            $customerModel->setUpdatedBy((int)$customer['updated_by']);
        }
        if (!empty($customer['created_at'])) {
            $customerModel->setCreatedAt($customer['created_at']);
        }
        if (!empty($customer['updated_at'])) {
            $customerModel->setUpdatedAt($customer['updated_at']);
        }
        if (!empty($customer['closest_task_at'])) {
            $customerModel->setClosestTaskAt($customer['closest_task_at'] > 0 ? (int)$customer['closest_task_at'] : null);
        }
        if (array_key_exists('is_deleted', $customer) && !is_null($customer['is_deleted'])) {
            $customerModel->setIsDeleted((bool)$customer['is_deleted']);
        }

        if (array_key_exists('average_check', $customer) && !is_null($customer['average_check'])) {
            $customerModel->setAverageCheck((int)$customer['average_check']);
        }

        if (array_key_exists('purchases_count', $customer) && !is_null($customer['purchases_count'])) {
            $customerModel->setPurchasesCount((int)$customer['purchases_count']);
        }

        if (!empty($customer[AmoCRMApiRequest::EMBEDDED]['tags'])) {
            $tagsCollection = new TagsCollection();
            $tagsCollection = $tagsCollection->fromArray($customer[AmoCRMApiRequest::EMBEDDED]['tags']);
            $customerModel->setTags($tagsCollection);
        }

        $segmentsCollection = new SegmentsCollection();
        if (!empty($customer[AmoCRMApiRequest::EMBEDDED][EntityTypesInterface::CUSTOMERS_SEGMENTS])) {
            $segmentsCollection = $segmentsCollection->fromArray(
                $customer[AmoCRMApiRequest::EMBEDDED][EntityTypesInterface::CUSTOMERS_SEGMENTS]
            );
        }
        $customerModel->setSegments($segmentsCollection);

        if (!empty($customer[AmoCRMApiRequest::EMBEDDED]['companies'][0])) {
            $company = CompanyModel::fromArray($customer[AmoCRMApiRequest::EMBEDDED]['companies'][0]);
            $customerModel->setCompany($company);
        }

        if (!empty($customer[AmoCRMApiRequest::EMBEDDED][self::CONTACTS])) {
            $contactsCollection = new ContactsCollection();
            $contactsCollection = $contactsCollection->fromArray($customer[AmoCRMApiRequest::EMBEDDED][self::CONTACTS]);
            $customerModel->setContacts($contactsCollection);
        }

        if (!empty($customer[AmoCRMApiRequest::EMBEDDED][self::CATALOG_ELEMENTS])) {
            $catalogElementsCollection = new CatalogElementsCollection();
            $catalogElementsCollection = $catalogElementsCollection->fromArray(
                $customer[AmoCRMApiRequest::EMBEDDED][self::CATALOG_ELEMENTS]
            );
            $customerModel->setCatalogElementsLinks($catalogElementsCollection);
        }

        if (!empty($customer['account_id'])) {
            $customerModel->setAccountId((int)$customer['account_id']);
        }

        return $customerModel;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        $result = [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'next_price' => $this->getNextPrice(),
            'next_date' => $this->getNextDate(),
            'responsible_user_id' => $this->getResponsibleUserId(),
            'status_id' => $this->getStatusId(),
            'periodicity' => $this->getPeriodicity(),
            'created_by' => $this->getCreatedBy(),
            'updated_by' => $this->getUpdatedBy(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
            'closest_task_at' => $this->getClosestTaskAt(),
            'is_deleted' => $this->getIsDeleted(),
            'custom_fields_values' => is_null($this->getCustomFieldsValues())
                ? null
                : $this->getCustomFieldsValues()->toArray(),
            'ltv' => $this->getLtv(),
            'purchases_count' => $this->getPurchasesCount(),
            'average_check' => $this->getAverageCheck(),
            'account_id' => $this->getAccountId(),
        ];

        if (!is_null($this->getCatalogElementsLinks())) {
            $result['catalog_elements'] = $this->getCatalogElementsLinks()->toArray();
        }

        if (!is_null($this->getTags())) {
            $result['tags'] = $this->getTags()->toArray();
        }

        if (!is_null($this->getCompany())) {
            $result['company'] = $this->getCompany()->toArray();
        }

        if (!is_null($this->getContacts())) {
            $result['contacts'] = $this->getContacts()->toArray();
        }

        if (!is_null($this->getSegments())) {
            $result['segments'] = $this->getSegments()->toArray();
        }

        return $result;
    }

    /**
     * @param string|null $requestId
     * @return array
     */
    public function toApi($requestId = "0")
    {
        $result = [];

        if (!is_null($this->getId())) {
            $result['id'] = $this->getId();
        }

        if (!is_null($this->getName())) {
            $result['name'] = $this->getName();
        }

        if (!is_null($this->getNextPrice())) {
            $result['next_price'] = $this->getNextPrice();
        }

        if (!is_null($this->getNextDate())) {
            $result['next_date'] = $this->getNextDate();
        }

        if (!is_null($this->getPeriodicity())) {
            $result['periodicity'] = $this->getPeriodicity();
        }

        if (!is_null($this->getResponsibleUserId())) {
            $result['responsible_user_id'] = $this->getResponsibleUserId();
        }

        if (!is_null($this->getStatusId())) {
            $result['status_id'] = $this->getStatusId();
        }

        if (!is_null($this->getCreatedBy())) {
            $result['created_by'] = $this->getCreatedBy();
        }

        if (!is_null($this->getUpdatedBy())) {
            $result['updated_by'] = $this->getUpdatedBy();
        }

        if (!is_null($this->getCreatedAt())) {
            $result['created_at'] = $this->getCreatedAt();
        }

        if (!is_null($this->getCustomFieldsValues())) {
            $result['custom_fields_values'] = $this->getCustomFieldsValues()->toApi();
        }

        if (!is_null($this->getTags())) {
            $result[AmoCRMApiRequest::EMBEDDED]['tags'] = $this->getTags()->toEntityApi();
        }

        if (!is_null($this->getSegments())) {
            $result[AmoCRMApiRequest::EMBEDDED]['segments'] = $this->getSegments()->toApi();
        }

        if (is_null($this->getRequestId()) && !is_null($requestId)) {
            $this->setRequestId($requestId); //Бага в API не принимает 0
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
            self::CATALOG_ELEMENTS,
            self::COMPANIES,
            self::CONTACTS,
        ];
    }

    /**
     * @return CatalogElementsCollection|null
     */
    public function getCatalogElementsLinks()
    {
        return $this->catalogElementsLinks;
    }

    /**
     * @param CatalogElementsCollection|null $catalogElementsLinks
     * @return CustomerModel
     */
    public function setCatalogElementsLinks(CatalogElementsCollection $catalogElementsLinks)
    {
        $this->catalogElementsLinks = $catalogElementsLinks;

        return $this;
    }

    /**
     * @return array|null
     */
    protected function getMetadataForLink()
    {
        $result = null;

        if (!is_null($this->getUpdatedBy())) {
            $result['updated_by'] = $this->getUpdatedBy();
        }

        return $result;
    }
}

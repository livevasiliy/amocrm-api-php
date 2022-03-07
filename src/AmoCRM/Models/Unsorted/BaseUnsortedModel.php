<?php

namespace AmoCRM\Models\Unsorted;

use AmoCRM\Exceptions\BadTypeException;
use AmoCRM\Helpers\EntityTypesInterface;
use AmoCRM\Models\Factories\UnsortedMetadataFactory;
use AmoCRM\Models\Traits\RequestIdTrait;
use AmoCRM\Models\Unsorted\Interfaces\UnsortedMetadataInterface;
use AmoCRM\Client\AmoCRMApiRequest;
use AmoCRM\Collections\CompaniesCollection;
use AmoCRM\Collections\ContactsCollection;
use AmoCRM\Exceptions\InvalidArgumentException;
use AmoCRM\Models\BaseApiModel;
use AmoCRM\Models\LeadModel;

class BaseUnsortedModel extends BaseApiModel
{
    use RequestIdTrait;

    const CATEGORY_CODE_SIP = 'sip';
    const CATEGORY_CODE_MAIL = 'mail';
    const CATEGORY_CODE_FORMS = 'forms';
    const CATEGORY_CODE_CHATS = 'chats';

    /**
     * @var string
     */
    protected $uid;

    /**
     * @var string
     */
    protected $category;

    /**
     * @var int|null
     */
    protected $createdAt;

    /**
     * @var null|int
     */
    protected $pipelineId;

    /**
     * @var string|null
     */
    protected $sourceName;

    /**
     * @var string|null
     */
    protected $sourceUid;

    /**
     * @var null|LeadModel
     */
    protected $lead;

    /**
     * @var null|ContactsCollection
     */
    protected $contacts;

    /**
     * @var null|CompaniesCollection
     */
    protected $companies;

    /**
     * @var UnsortedMetadataInterface|null
     */
    protected $metadata;

    /**
     * @return string
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @param string $uid
     * @return BaseUnsortedModel
     */
    public function setUid($uid)
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $category
     * @return BaseUnsortedModel
     */
    protected function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param int $createdAt
     * @return BaseUnsortedModel
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return null|int
     */
    public function getPipelineId()
    {
        return $this->pipelineId;
    }

    /**
     * @param int $pipelineId
     * @return BaseUnsortedModel
     */
    public function setPipelineId($pipelineId)
    {
        $this->pipelineId = $pipelineId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSourceName()
    {
        return $this->sourceName;
    }

    /**
     * @param string $sourceName
     * @return BaseUnsortedModel
     */
    public function setSourceName($sourceName)
    {
        $this->sourceName = $sourceName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSourceUid()
    {
        return $this->sourceUid;
    }

    /**
     * @param string $sourceUid
     * @return BaseUnsortedModel
     */
    public function setSourceUid($sourceUid)
    {
        $this->sourceUid = $sourceUid;

        return $this;
    }

    /**
     * @return LeadModel|null
     */
    public function getLead()
    {
        return $this->lead;
    }

    /**
     * @param LeadModel|null $lead
     * @return BaseUnsortedModel
     */
    public function setLead($lead)
    {
        $this->lead = $lead;

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
     * @param ContactsCollection|null $contacts
     * @return BaseUnsortedModel
     */
    public function setContacts($contacts)
    {
        $this->contacts = $contacts;

        return $this;
    }

    /**
     * @return CompaniesCollection|null
     */
    public function getCompanies()
    {
        return $this->companies;
    }

    /**
     * @param CompaniesCollection|null $companies
     * @return BaseUnsortedModel
     */
    public function setCompanies($companies)
    {
        $this->companies = $companies;
        return $this;
    }

    /**
     * @return UnsortedMetadataInterface|null
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * @param UnsortedMetadataInterface $metadata
     * @return BaseUnsortedModel
     */
    public function setMetadata(UnsortedMetadataInterface $metadata)
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * @param array $unsorted
     *
     * @return self
     * @throws InvalidArgumentException|BadTypeException
     */
    public static function fromArray(array $unsorted)
    {
        if (empty($unsorted['uid'])) {
            throw new InvalidArgumentException('Unsorted uid is empty in ' . json_encode($unsorted));
        }

        $unsortedModel = new self();

        $unsortedModel->setUid($unsorted['uid']);

        if (array_key_exists('source_uid', $unsorted) && !is_null($unsorted['source_uid'])) {
            $unsortedModel->setSourceUid($unsorted['source_uid']);
        }

        if (array_key_exists('source_name', $unsorted) && !is_null($unsorted['source_name'])) {
            $unsortedModel->setSourceName($unsorted['source_name']);
        }

        if (array_key_exists('category', $unsorted) && !is_null($unsorted['category'])) {
            $unsortedModel->setCategory($unsorted['category']);
        }

        if (array_key_exists('pipeline_id', $unsorted) && !is_null($unsorted['pipeline_id'])) {
            $unsortedModel->setPipelineId($unsorted['pipeline_id']);
        }

        if (array_key_exists('created_at', $unsorted) && !is_null($unsorted['created_at'])) {
            $unsortedModel->setCreatedAt($unsorted['created_at']);
        }

        if (array_key_exists('metadata', $unsorted) && !is_null($unsorted['metadata'])) {
            $metadataModel = UnsortedMetadataFactory::createForCategory($unsorted['category'], $unsorted['metadata']);
            $unsortedModel->setMetadata($metadataModel);
        }

        $leadModel = new LeadModel();
        if (!empty($unsorted[AmoCRMApiRequest::EMBEDDED]['leads'])) {
            $leadModel = LeadModel::fromArray(reset($unsorted[AmoCRMApiRequest::EMBEDDED]['leads']));
        }
        $unsortedModel->setLead($leadModel);

        $contactsCollection = new ContactsCollection();
        if (!empty($unsorted[AmoCRMApiRequest::EMBEDDED][EntityTypesInterface::CONTACTS])) {
            $contactsCollection = $contactsCollection->fromArray($unsorted[AmoCRMApiRequest::EMBEDDED][EntityTypesInterface::CONTACTS]);
        }
        $unsortedModel->setContacts($contactsCollection);

        $companiesCollection = new CompaniesCollection();
        if (!empty($unsorted[AmoCRMApiRequest::EMBEDDED][EntityTypesInterface::COMPANIES])) {
            $companiesCollection = new CompaniesCollection();
            $companiesCollection = $companiesCollection->fromArray($unsorted[AmoCRMApiRequest::EMBEDDED][EntityTypesInterface::COMPANIES]);
        }
        $unsortedModel->setCompanies($companiesCollection);

        return $unsortedModel;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        $result = [
            'uid' => $this->getUid(),
        ];

        if (!is_null($this->getCategory())) {
            $result['category'] = $this->getCategory();
        }

        if (!is_null($this->getSourceName())) {
            $result['source_name'] = $this->getSourceName();
        }

        if (!is_null($this->getSourceUid())) {
            $result['source_uid'] = $this->getSourceUid();
        }

        if (!is_null($this->getPipelineId())) {
            $result['pipeline_id'] = $this->getPipelineId();
        }

        if (!is_null($this->getCreatedAt())) {
            $result['created_at'] = $this->getCreatedAt();
        }

        if (!is_null($this->getMetadata())) {
            $result['metadata'] = $this->getMetadata()->toArray();
        }

        if (!is_null($this->getLead())) {
            $result['lead'] = $this->getLead()->toArray();
        }

        if (!is_null($this->getLead())) {
            $result['leads'] = [$this->getLead()->toArray()];
        }

        if (!is_null($this->getCompanies())) {
            $result['companies'] = $this->getCompanies()->toArray();
        }

        if (!is_null($this->getContacts())) {
            $result['contacts'] = $this->getContacts()->toArray();
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

        if (!is_null($this->getSourceName())) {
            $result['source_name'] = $this->getSourceName();
        }

        if (!is_null($this->getSourceUid())) {
            $result['source_uid'] = $this->getSourceUid();
        }

        if (!is_null($this->getPipelineId())) {
            $result['pipeline_id'] = $this->getPipelineId();
        }

        if (!is_null($this->getCreatedAt())) {
            $result['created_at'] = $this->getCreatedAt();
        }

        if (!is_null($this->getMetadata())) {
            $result['metadata'] = $this->getMetadata()->toApi();
        }

        if (is_null($this->getRequestId()) && !is_null($requestId)) {
            $this->setRequestId($requestId);
        }

        $requestId = $this->getRequestId();

        if (!is_null($this->getLead())) {
            $result[AmoCRMApiRequest::EMBEDDED]['leads'] = [$this->getLead()->toApi($requestId)];
        }

        if (!is_null($this->getCompanies())) {
            $result[AmoCRMApiRequest::EMBEDDED]['companies'] = $this->getCompanies()->toApi();
        }

        if (!is_null($this->getContacts())) {
            $result[AmoCRMApiRequest::EMBEDDED]['contacts'] = $this->getContacts()->toApi();
        }

        $result['request_id'] = $requestId;

        return $result;
    }

    /**
     * @return array
     */
    public static function getAvailableWith()
    {
        return [];
    }
}

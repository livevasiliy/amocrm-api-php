<?php

namespace AmoCRM\Models\Unsorted;

use AmoCRM\Client\AmoCRMApiRequest;
use AmoCRM\Collections\CompaniesCollection;
use AmoCRM\Collections\ContactsCollection;
use AmoCRM\Collections\Leads\LeadsCollection;
use Illuminate\Contracts\Support\Arrayable;

class LinkUnsortedModel implements Arrayable
{
    /**
     * @var string
     */
    protected $uid;

    /**
     * @var LeadsCollection|null
     */
    protected $leads;

    /**
     * @var ContactsCollection|null
     */
    protected $contacts;

    /**
     * @var CompaniesCollection|null
     */
    protected $companies;

    /**
     * @param array $result
     * @return self
     */
    public static function fromArray(array $result)
    {
        $model = new self();

        $model->setUid($result['uid']);

        if (!empty($result[AmoCRMApiRequest::EMBEDDED]['leads'])) {
            $leadsCollection = new LeadsCollection();
            $leadsCollection = $leadsCollection->fromArray($result[AmoCRMApiRequest::EMBEDDED]['leads']);
            $model->setLeads($leadsCollection);
        }

        if (!empty($result[AmoCRMApiRequest::EMBEDDED]['contacts'])) {
            $contactsCollection = new ContactsCollection();
            $contactsCollection = $contactsCollection->fromArray($result[AmoCRMApiRequest::EMBEDDED]['contacts']);
            $model->setContacts($contactsCollection);
        }

        if (!empty($result[AmoCRMApiRequest::EMBEDDED]['companies'])) {
            $companiesCollection = new CompaniesCollection();
            $companiesCollection = $companiesCollection->fromArray($result[AmoCRMApiRequest::EMBEDDED]['companies']);
            $model->setCompanies($companiesCollection);
        }

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'uid' => $this->getUid(),
            'leads' => $this->getLeads()->toArray(),
            'contacts' => $this->getContacts()->toArray(),
            'companies' => $this->getCompanies()->toArray(),
        ];
    }

    /**
     * @return string
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @param string $uid
     * @return LinkUnsortedModel
     */
    public function setUid($uid)
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * @return LeadsCollection|null
     */
    public function getLeads()
    {
        return $this->leads;
    }

    /**
     * @param LeadsCollection|null $leads
     * @return LinkUnsortedModel
     */
    public function setLeads($leads)
    {
        $this->leads = $leads;

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
     * @return LinkUnsortedModel
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
     * @return LinkUnsortedModel
     */
    public function setCompanies($companies)
    {
        $this->companies = $companies;

        return $this;
    }
}

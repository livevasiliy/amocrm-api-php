<?php

namespace AmoCRM\Models\NoteType;

use AmoCRM\Exceptions\InvalidArgumentException;
use AmoCRM\Models\NoteModel;

abstract class TargetingNote extends NoteModel
{
    const TARGETING_NOTE_SERVICE_FACEBOOK = 'facebook';
    const TARGETING_NOTE_SERVICE_VKONTAKTE = 'vkontakte';
    const TARGETING_NOTE_SERVICE_MAILCHIMP = 'mailchimp';
    const TARGETING_NOTE_SERVICE_ADWORDS = 'adwords';

    const AVAILABLE_SERVICES = [
        self::TARGETING_NOTE_SERVICE_ADWORDS,
        self::TARGETING_NOTE_SERVICE_MAILCHIMP,
        self::TARGETING_NOTE_SERVICE_VKONTAKTE,
        self::TARGETING_NOTE_SERVICE_FACEBOOK,
    ];

    /**
     * @var null|array
     */
    protected $contacts;

    /**
     * @var null|string
     */
    protected $campaign;

    /**
     * @var int|string
     */
    protected $service;

    /**
     * @param array $note
     *
     * @return NoteModel
     * @throws InvalidArgumentException
     */
    public function fromArray(array $note)
    {
        $model = parent::fromArray($note);

        if (isset($note['params']['contacts'])) {
            $model->setContacts($note['params']['contacts']);
        }

        if (isset($note['params']['campaign'])) {
            $model->setCampaign($note['params']['campaign']);
        }

        if (isset($note['params']['service'])) {
            $model->setService($note['params']['service']);
        }

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        $result = parent::toArray();

        $result['params'] = [
            'contacts' => $this->getContacts(),
            'campaign' => $this->getCampaign(),
            'service' => $this->getService(),
        ];

        return $result;
    }

    /**
     * @param string|null $requestId
     * @return array
     */
    public function toApi($requestId = "0")
    {
        $result = parent::toApi($requestId);

        $result['params'] = [
            'contacts' => $this->getContacts(),
            'campaign' => $this->getCampaign(),
            'service' => $this->getService(),
        ];

        return $result;
    }

    /**
     * @return null|array
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * @param array|null $contacts
     * @return TargetingNote
     */
    public function setContacts($contacts)
    {
        $this->contacts = $contacts;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCampaign()
    {
        return $this->campaign;
    }

    /**
     * @param string|null $campaign
     * @return TargetingNote
     */
    public function setCampaign($campaign)
    {
        $this->campaign = $campaign;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param string|null $service
     *
     * @return TargetingNote
     * @throws InvalidArgumentException
     */
    public function setService($service)
    {
        if (!in_array($service, self::AVAILABLE_SERVICES, true)) {
            throw new InvalidArgumentException('Invalid value given:' . $service);
        }

        $this->service = $service;

        return $this;
    }
}

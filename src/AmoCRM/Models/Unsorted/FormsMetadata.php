<?php

namespace AmoCRM\Models\Unsorted;

use AmoCRM\Models\BaseApiModel;
use AmoCRM\Models\Unsorted\Interfaces\UnsortedMetadataInterface;
use Illuminate\Contracts\Support\Arrayable;

use function array_key_exists;
use function is_null;
use function time;

class FormsMetadata extends BaseApiModel implements Arrayable, UnsortedMetadataInterface
{
    /**
     * @var string|int|null
     */
    protected $formId;

    /**
     * @var string|null
     */
    protected $formName;

    /**
     * @var string|null
     */
    protected $formPage;

    /**
     * @var string|null
     */
    protected $ip;

    /**
     * @var int|null
     */
    protected $formSentAt;

    /**
     * @var string|null
     */
    protected $referer;

    /**
     * @var string|null
     */
    protected $visitorUid;

    /**
     * @var int|null
     */
    protected $formType;

    /**
     * @param array $metadata
     *
     * @return self
     */
    public static function fromArray(array $metadata)
    {
        $model = new self();

        $model->setFormId($metadata['form_id']);
        $model->setFormName($metadata['form_name']);
        $model->setFormPage($metadata['form_page']);
        $model->setFormSentAt($metadata['form_sent_at']);

        if (array_key_exists('ip', $metadata) && !is_null($metadata['ip'])) {
            $model->setIp($metadata['ip']);
        }
        if (array_key_exists('form_type', $metadata) && !is_null($metadata['form_type'])) {
            $model->setFormType((int)$metadata['form_type']);
        }
        if (array_key_exists('referer', $metadata) && !is_null($metadata['referer'])) {
            $model->setReferer($metadata['referer']);
        }
        if (array_key_exists('visitor_uid', $metadata) && !is_null($metadata['visitor_uid'])) {
            $model->setVisitorUid($metadata['visitor_uid']);
        }

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'form_id' => $this->getFormId(),
            'form_name' => $this->getFormName(),
            'form_page' => $this->getFormPage(),
            'ip' => $this->getIp(),
            'form_sent_at' => $this->getFormSentAt(),
            'referer' => $this->getReferer(),
            'visitor_uid' => $this->getVisitorUid(),
            'form_type' => $this->getFormType(),
        ];
    }

    /**
     * @return int|string|null
     */
    public function getFormId()
    {
        return $this->formId;
    }

    /**
     * @param int|string|null $formId
     * @return FormsMetadata
     */
    public function setFormId($formId)
    {
        $this->formId = $formId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFormName()
    {
        return $this->formName;
    }

    /**
     * @param string|null $formName
     * @return FormsMetadata
     */
    public function setFormName($formName)
    {
        $this->formName = $formName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFormPage()
    {
        return $this->formPage;
    }

    /**
     * @param string|null $formPage
     * @return FormsMetadata
     */
    public function setFormPage($formPage)
    {
        $this->formPage = $formPage;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param string|null $ip
     * @return FormsMetadata
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getFormSentAt()
    {
        return $this->formSentAt;
    }

    /**
     * @param int|null $formSentAt
     * @return FormsMetadata
     */
    public function setFormSentAt($formSentAt)
    {
        $this->formSentAt = $formSentAt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getReferer()
    {
        return $this->referer;
    }

    /**
     * @param string|null $referer
     * @return FormsMetadata
     */
    public function setReferer($referer)
    {
        $this->referer = $referer;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getVisitorUid()
    {
        return $this->visitorUid;
    }

    /**
     * @param string|null $visitorUid
     * @return FormsMetadata
     */
    public function setVisitorUid($visitorUid)
    {
        $this->visitorUid = $visitorUid;

        return $this;
    }

    public function setFormType($formType)
    {
        $this->formType = $formType;

        return $this;
    }

    public function getFormType()
    {
        return $this->formType;
    }

    /**
     * @param string|null $requestId
     * @return array
     */
    public function toApi($requestId = "0")
    {
        $result = [
            'form_id'      => $this->getFormId(),
            'form_name'    => $this->getFormName(),
            'form_page'    => $this->getFormPage(),
            'form_sent_at' => !is_null($this->getFormSentAt()) ? $this->getFormSentAt() : time(),
        ];

        if ($ip = $this->getIp()) {
            $result['ip'] = $ip;
        }
        if ($referer = $this->getReferer()) {
            $result['referer'] = $referer;
        }
        if ($formType = $this->getFormType()) {
            $result['form_type'] = $formType;
        }
        if ($visitorUid = $this->getVisitorUid()) {
            $result['visitor_uid'] = $visitorUid;
        }

        return $result;
    }

    /**
     * @return array
     */
    public function toComplexApi()
    {
        $result = $this->toApi();

        $result['category'] = BaseUnsortedModel::CATEGORY_CODE_FORMS;

        return $result;
    }
}

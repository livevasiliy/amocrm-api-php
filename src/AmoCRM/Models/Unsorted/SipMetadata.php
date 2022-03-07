<?php

namespace AmoCRM\Models\Unsorted;

use AmoCRM\Models\Unsorted\Interfaces\UnsortedMetadataInterface;
use AmoCRM\Models\BaseApiModel;
use Illuminate\Contracts\Support\Arrayable;

use function is_scalar;

class SipMetadata extends BaseApiModel implements Arrayable, UnsortedMetadataInterface
{
    /**
     * @var int|string|null
     */
    protected $from;

    /**
     * @var string|null
     */
    protected $phone;

    /**
     * @var int|null
     */
    protected $calledAt;

    /**
     * @var int|null
     */
    protected $duration;

    /**
     * @var string|null
     */
    protected $link;

    /**
     * @var string|null
     */
    protected $serviceCode;

    /**
     * @var string|null
     */
    protected $uniq;

    /**
     * @var bool|null
     */
    protected $isCallEventNeeded;

    /**
     * @param array $metadata
     *
     * @return self
     */
    public static function fromArray(array $metadata)
    {
        $model = new self();

        $model->setFrom(isset($metadata['from']) ? $metadata['from'] : null);
        $model->setPhone(isset($metadata['phone']) ? $metadata['phone'] : null);
        $model->setCalledAt(isset($metadata['called_at']) ? $metadata['called_at'] : null);
        $model->setDuration(isset($metadata['duration']) ? $metadata['duration'] : null);
        $model->setLink(isset($metadata['link']) ? $metadata['link'] : null);
        $model->setServiceCode(isset($metadata['service_code']) ? $metadata['service_code'] : null);
        $model->setUniq(isset($metadata['uniq']) ? $metadata['uniq'] : null);

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'from' => $this->getFrom(),
            'phone' => $this->getPhone(),
            'called_at' => $this->getCalledAt(),
            'duration' => $this->getDuration(),
            'link' => $this->getLink(),
            'service_code' => $this->getServiceCode(),
            'uniq' => $this->getUniq(),
        ];
    }

    /**
     * @return int|null
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param int|null|string $from
     * @return SipMetadata
     */
    public function setFrom($from)
    {
        if (is_scalar($from)) {
            $this->from = $from;
        } else {
            $this->from = null;
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     * @return SipMetadata
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCalledAt()
    {
        return $this->calledAt;
    }

    /**
     * @param int|null $calledAt
     * @return SipMetadata
     */
    public function setCalledAt($calledAt)
    {
        $this->calledAt = $calledAt;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param int|null $duration
     * @return SipMetadata
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string|null $link
     * @return SipMetadata
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getServiceCode()
    {
        return $this->serviceCode;
    }

    /**
     * @param string|null $serviceCode
     * @return SipMetadata
     */
    public function setServiceCode($serviceCode)
    {
        $this->serviceCode = $serviceCode;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUniq()
    {
        return $this->uniq;
    }

    /**
     * @param string|null $uniq
     * @return SipMetadata
     */
    public function setUniq($uniq)
    {
        $this->uniq = $uniq;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsCallEventNeeded()
    {
        return $this->isCallEventNeeded;
    }

    /**
     * @param bool|null $isCallEventNeeded
     *
     * @return SipMetadata
     */
    public function setIsCallEventNeeded($isCallEventNeeded)
    {
        $this->isCallEventNeeded = $isCallEventNeeded;

        return $this;
    }

    /**
     * @param string|null $requestId
     * @return array
     */
    public function toApi($requestId = "0")
    {
        return [
            'from' => $this->getFrom(),
            'phone' => $this->getPhone(),
            'called_at' => !is_null($this->getCalledAt()) ? $this->getCalledAt() : time(),
            'duration' => $this->getDuration(),
            'link' => $this->getLink(),
            'service_code' => $this->getServiceCode(),
            'uniq' => $this->getUniq(),
            'is_call_event_needed' => $this->getIsCallEventNeeded() !== null ? $this->getIsCallEventNeeded() : true,
        ];
    }

    /**
     * @return array
     */
    public function toComplexApi()
    {
        $result = $this->toApi();

        $result['category'] = BaseUnsortedModel::CATEGORY_CODE_SIP;

        return $result;
    }
}

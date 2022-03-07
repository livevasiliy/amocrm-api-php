<?php

namespace AmoCRM\Models\Traits;

/**
 * Trait RequestIdTrait
 *
 * @package AmoCRM\Models\Traits
 */
trait RequestIdTrait
{
    /**
     * @var string|null
     */
    protected $requestId;

    /**
     * @return string|null
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * @param string|int|null $requestId
     * @return self
     */
    public function setRequestId($requestId = null)
    {
        $this->requestId = (string)$requestId;

        return $this;
    }
}

<?php

namespace AmoCRM\Exceptions;

use Exception;

/**
 * Class AmoCRMApiException
 *
 * @package AmoCRM\Exceptions
 */
class AmoCRMApiException extends Exception
{
    /**
     * @var int
     */
    protected $errorCode;

    /**
     * @var string
     */
    protected $description = "";

    /**
     * @var string
     */
    protected $title = "";

    /**
     * @var array
     */
    protected $lastRequestInfo = [];

    /**
     * AmoCRMApiException constructor.
     * @param string $message
     * @param int $code
     * @param array $lastRequestInfo
     * @param string $description
     * @param Exception|null $previous
     */
    public function __construct(
        $message = "",
        $code = 0,
        array $lastRequestInfo = [],
        $description = "",
        $previous = null
    ) {
        parent::__construct($message, $code, $previous);

        $this
            ->setTitle($message)
            ->setErrorCode($code)
            ->setLastRequestInfo($lastRequestInfo)
            ->setDescription($description);
    }

    /**
     * @return int
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @param int $errorCode
     * @return AmoCRMApiException
     */
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;

        return $this;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return array|null
     */
    public function getLastRequestInfo()
    {
        return $this->lastRequestInfo;
    }

    /**
     * @param array $lastRequestInfo
     * @return AmoCRMApiException
     */
    public function setLastRequestInfo(array $lastRequestInfo)
    {
        $this->lastRequestInfo = $lastRequestInfo;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return AmoCRMApiException
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
}

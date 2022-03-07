<?php

namespace AmoCRM\Models;

use DateTimeImmutable;
use Lcobucci\JWT\Token;

/**
 * Class DisposableTokenModel
 *
 * @package AmoCRM\Models
 */
class DisposableTokenModel extends BaseApiModel
{
    /** @var string */
    protected $tokenUuid;

    /** @var string */
    protected $clientUuid;

    /** @var string */
    protected $accountDomain;

    /** @var string */
    protected $accountSubdomain;

    /** @var int */
    protected $accountId;

    /** @var int */
    protected $userId;

    /** @var int */
    protected $expiresAt;

    /**
     * @param string $tokenUuid
     *
     * @return $this
     */
    public function setTokenUuid($tokenUuid)
    {
        $this->tokenUuid = $tokenUuid;

        return $this;
    }

    /**
     * @return string
     */
    public function getTokenUuid()
    {
        return $this->tokenUuid;
    }

    /**
     * @param string $clientUuid
     *
     * @return $this
     */
    public function setClientUuid($clientUuid)
    {
        $this->clientUuid = $clientUuid;

        return $this;
    }

    /**
     * @return string
     */
    public function getClientUuid()
    {
        return $this->clientUuid;
    }

    /**
     * @param string $accountDomain
     *
     * @return $this
     */
    public function setAccountDomain($accountDomain)
    {
        $this->accountDomain = $accountDomain;

        return $this;
    }

    /**
     * @return string
     */
    public function getAccountDomain()
    {
        return $this->accountDomain;
    }

    /**
     * @param string $accountSubdomain
     *
     * @return $this
     */
    public function setAccountSubdomain($accountSubdomain)
    {
        $this->accountSubdomain = $accountSubdomain;

        return $this;
    }

    /**
     * @return string
     */
    public function getAccountSubdomain()
    {
        return $this->accountSubdomain;
    }

    /**
     * @param int $accountId
     *
     * @return $this
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;

        return $this;
    }

    /**
     * @return int
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @param int $userId
     *
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * @param int $expiresAt
     *
     * @return DisposableTokenModel
     */
    public function setExpiresAt($expiresAt)
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }


    /**
     * @param Token $jwtToken
     *
     * @return static
     */
    public static function fromJwtToken(Token $jwtToken)
    {
        $disposableToken = new self();
        $claims = $jwtToken->claims();
        /** @var DateTimeImmutable $expiresAt */
        $expiresAt = $claims->get('exp');
        $disposableToken->setTokenUuid($claims->get('jti'))
            ->setClientUuid($claims->get('client_uuid'))
            ->setAccountDomain($claims->get('iss'))
            ->setAccountSubdomain($claims->get('subdomain'))
            ->setAccountId((int)$claims->get('account_id'))
            ->setUserId((int)$claims->get('user_id'))
            ->setExpiresAt($expiresAt->getTimestamp());

        return $disposableToken;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'token_uuid'        => $this->getTokenUuid(),
            'client_uuid'       => $this->getClientUuid(),
            'account_domain'    => $this->getAccountDomain(),
            'account_subdomain' => $this->getAccountSubdomain(),
            'account_id'        => $this->getAccountId(),
            'user_id'           => $this->getUserId(),
            'expires_at'        => $this->getExpiresAt(),
        ];
    }

    /**
     * @param string|null $requestId
     *
     * @return array
     */
    public function toApi($requestId = null)
    {
        return $this->toArray();
    }
}

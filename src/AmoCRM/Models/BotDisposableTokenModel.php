<?php

namespace AmoCRM\Models;

use AmoCRM\Helpers\EntityTypesInterface;
use DateTimeImmutable;
use Lcobucci\JWT\Token;

/**
 * Class DisposableBotTokenModel
 *
 * @package AmoCRM\Models
 */
class BotDisposableTokenModel extends BaseApiModel
{
    const MARKETINGBOT = 'marketingbot';

    const SALESBOT = 'salesbot';

    /** @var string */
    protected $clientUuid;

    /** @var string */
    protected $accountDomain;

    /** @var string */
    protected $accountSubdomain;

    /** @var int */
    protected $accountId;

    /** @var string */
    protected $botType;

    /** @var string */
    protected $entityType;

    /** @var int */
    protected $entityId;

    /** @var int */
    protected $expiresAt;

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
     * @return int
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * @param int $expiresAt
     *
     * @return BotDisposableTokenModel
     */
    public function setExpiresAt($expiresAt)
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getBotType()
    {
        return $this->botType;
    }

    /**
     * @param string $botType
     *
     * @return BotDisposableTokenModel
     */
    public function setBotType($botType)
    {
        $this->botType = $botType;

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
     * @return BotDisposableTokenModel
     */
    public function setEntityType($entityType)
    {
        $this->entityType = $entityType;

        return $this;
    }

    /**
     * @return int
     */
    public function getEntityId()
    {
        return $this->entityId;
    }

    /**
     * @param int $entityId
     *
     * @return BotDisposableTokenModel
     */
    public function setEntityId($entityId)
    {
        $this->entityId = $entityId;

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
        $entityType = $claims->get('entity_type');
        if ($entityType == 2) {
            $entityType = EntityTypesInterface::LEADS;
        } elseif ($entityType == 12) {
            $entityType = EntityTypesInterface::CUSTOMERS;
        }

        $disposableToken
            ->setClientUuid($claims->get('client_uuid'))
            ->setAccountDomain($claims->get('iss'))
            ->setAccountSubdomain($claims->get('subdomain'))
            ->setAccountId((int)$claims->get('account_id'))
            ->setEntityId($claims->get('entity_id'))
            ->setEntityType((string)$entityType)
            ->setBotType($claims->get('bot_type'))
            ->setExpiresAt($expiresAt->getTimestamp());

        return $disposableToken;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'client_uuid' => $this->getClientUuid(),
            'account_domain' => $this->getAccountDomain(),
            'account_subdomain' => $this->getAccountSubdomain(),
            'account_id' => $this->getAccountId(),
            'expires_at' => $this->getExpiresAt(),
            'entity_id' => $this->getEntityId(),
            'entity_type' => $this->getEntityType(),
            'bot_type' => $this->getBotType(),
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

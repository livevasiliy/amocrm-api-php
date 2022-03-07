<?php

namespace AmoCRM\Models;

/**
 * Class AccountDomainModel
 *
 * @package AmoCRM\Models
 */
class AccountDomainModel extends BaseApiModel
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $subdomain;

    /** @var string */
    protected $domain;

    /** @var string */
    protected $topLevelDomain;

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $subdomain
     *
     * @return $this
     */
    public function setSubdomain($subdomain)
    {
        $this->subdomain = $subdomain;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubdomain()
    {
        return $this->subdomain;
    }

    /**
     * @param string $domain
     *
     * @return $this
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param string $topLevelDomain
     *
     * @return $this
     */
    public function setTopLevelDomain($topLevelDomain)
    {
        $this->topLevelDomain = $topLevelDomain;

        return $this;
    }

    /**
     * @return string
     */
    public function getTopLevelDomain()
    {
        return $this->topLevelDomain;
    }

    /**
     * @param array $accountDomain
     *
     * @return static
     */
    public static function fromArray(array $accountDomain)
    {
        $accountDomainModel = new self();
        $accountDomainModel->setId((int)$accountDomain['id'])
            ->setSubdomain($accountDomain['subdomain'])
            ->setDomain($accountDomain['domain'])
            ->setTopLevelDomain($accountDomain['top_level_domain']);

        return $accountDomainModel;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id'               => $this->getId(),
            'subdomain'        => $this->getSubdomain(),
            'domain'           => $this->getDomain(),
            'top_level_domain' => $this->getTopLevelDomain(),
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

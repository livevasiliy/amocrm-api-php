<?php

namespace AmoCRM\OAuth;

/**
 * Интерфейс для настроек Oauth клиента
 * Interface CrmOauthConfigInterface
 *
 * @package AmoCRM\OAuth
 */
interface OAuthConfigInterface
{
    /**
     * @return string
     */
    public function getIntegrationId();

    /**
     * @return string
     */
    public function getSecretKey();

    /**
     * @return string
     */
    public function getRedirectDomain();
}

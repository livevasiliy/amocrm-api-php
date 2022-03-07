<?php

namespace AmoCRM\OAuth;

use League\OAuth2\Client\Token\AccessTokenInterface;

/**
 * Интерфейс сервиса, который может сохранять oauth токены
 * Interface CrmOauthServiceInterface
 *
 * @package AmoCRM\OAuth
 */
interface OAuthServiceInterface
{
    /**
     * @param AccessTokenInterface $accessToken
     * @param string               $baseDomain
     *
     * @return void
     */
    public function saveOAuthToken(AccessTokenInterface $accessToken, $baseDomain);
}

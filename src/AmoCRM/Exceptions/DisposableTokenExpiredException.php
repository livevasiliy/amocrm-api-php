<?php

namespace AmoCRM\Exceptions;

/**
 * Class InvalidDisposableTokenException
 *
 * Выбрасывается в случае, если истёк срок жизни токена
 *
 * @package AmoCRM\Exceptions
 */
class DisposableTokenExpiredException extends AmoCRMApiException
{
    /**
     * @return DisposableTokenExpiredException
     */
    public static function create()
    {
        return new self('Disposable token expired');
    }
}

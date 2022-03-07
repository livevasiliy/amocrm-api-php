<?php

namespace AmoCRM\Exceptions;

/**
 * Class DisposableTokenVerificationFailedException
 *
 * Выбрасывается в случае неверной подписи токена
 *
 * @package AmoCRM\Exceptions
 */
class DisposableTokenVerificationFailedException extends AmoCRMApiException
{
    /**
     * @return DisposableTokenVerificationFailedException
     */
    public static function create()
    {
        return new self('Disposable token verification signature failed');
    }
}

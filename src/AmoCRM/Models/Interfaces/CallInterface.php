<?php

namespace AmoCRM\Models\Interfaces;

/**
 * Interface CallInterface
 *
 * @package AmoCRM\Models\Interfaces
 */
interface CallInterface
{
    const CALL_STATUS_LEAVE_MESSAGE = 1;
    const CALL_STATUS_SUCCESS_RECALL = 2;
    const CALL_STATUS_SUCCESS_NOT_IN_STOCK = 3;
    const CALL_STATUS_SUCCESS_CONVERSATION = 4;
    const CALL_STATUS_FAIL_WRONG_NUMBER = 5;
    const CALL_STATUS_FAIL_NOT_PHONED = 6;
    const CALL_STATUS_FAIL_BUSY = 7;
    const CALL_STATUS_UNDEFINED = 8;
    const AVAILABLE_CALL_STATUSES = [
        self::CALL_STATUS_LEAVE_MESSAGE,
        self::CALL_STATUS_SUCCESS_RECALL,
        self::CALL_STATUS_SUCCESS_NOT_IN_STOCK,
        self::CALL_STATUS_SUCCESS_CONVERSATION,
        self::CALL_STATUS_FAIL_WRONG_NUMBER,
        self::CALL_STATUS_FAIL_NOT_PHONED,
        self::CALL_STATUS_FAIL_BUSY,
        self::CALL_STATUS_UNDEFINED,
    ];

    const CALL_DIRECTION_IN = 'inbound';
    const CALL_DIRECTION_OUT = 'outbound';
}

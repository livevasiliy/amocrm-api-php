<?php

namespace AmoCRM\Models\Customers;

/**
 * Модель для начисления/списания баллов покупателю
 *
 * @package AmoCRM\Models\Customers
 */
class BonusPointsActionModel
{
    /** @var int */
    protected $customerId;

    /** @var int */
    protected $points;

    /**
     * BonusPointsActionModel constructor.
     * @param int $customerId
     * @param int $points
     */
    public function __construct($customerId, $points)
    {
        $this->customerId = $customerId;
        $this->points = $points;
    }

    /**
     * @return int
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }
}

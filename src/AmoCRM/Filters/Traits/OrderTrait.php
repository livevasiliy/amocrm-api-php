<?php

namespace AmoCRM\Filters\Traits;

use AmoCRM\Filters\Interfaces\HasOrderInterface;

trait OrderTrait
{
    /**
     * @var string|null
     */
    private $orderField;

    /**
     * @var string|null
     */
    private $direction;

    /**
     * @param string $field
     * @param string $direction
     *
     * @return $this
     */
    public function setOrder($field, $direction = HasOrderInterface::SORT_ASC)
    {
        $this->orderField = $field;
        $this->direction = $direction;

        return $this;
    }

    /**
     * @return null|array
     */
    public function getOrder()
    {
        return empty($this->orderField) || empty($this->direction) ? null : [$this->orderField => $this->direction];
    }
}

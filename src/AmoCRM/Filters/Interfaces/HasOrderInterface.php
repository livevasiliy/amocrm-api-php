<?php

namespace AmoCRM\Filters\Interfaces;

/**
 * Интерфейс для фильтров, которые поддерживают постраничную навигацию
 * @package AmoCRM\Filters\Interfaces
 */
interface HasOrderInterface
{
    const SORT_ASC = 'asc';
    const SORT_DESC = 'desc';

    /**
     * @param string $field
     * @param string $direction
     *
     * @return $this
     */
    public function setOrder($field, $direction = self::SORT_ASC);

    /**
     * @return null|array
     */
    public function getOrder();
}

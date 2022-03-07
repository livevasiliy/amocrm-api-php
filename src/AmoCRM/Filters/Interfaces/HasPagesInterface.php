<?php

namespace AmoCRM\Filters\Interfaces;

/**
 * Интерфейс для фильтров, которые поддерживают постраничную навигацию
 * @package AmoCRM\Filters\Interfaces
 */
interface HasPagesInterface
{
    public function setPage($page);

    public function getPage();

    public function setLimit($limit);

    public function getLimit();
}

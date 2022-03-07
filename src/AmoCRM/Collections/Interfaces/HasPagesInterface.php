<?php

namespace AmoCRM\Collections\Interfaces;

use AmoCRM\Collections\BaseApiCollection;

/**
 * Интерфейс для фильтров, которые поддерживают постраничную навигацию
 * @package AmoCRM\Filters\Interfaces
 */
interface HasPagesInterface
{
    /**
     * @param string $url
     * @return BaseApiCollection
     */
    public function setNextPageLink($url);

    /**
     * @return string|null
     */
    public function getNextPageLink();

    /**
     * @param string $url
     * @return BaseApiCollection
     */
    public function setPrevPageLink($url);

    /**
     * @return string|null
     */
    public function getPrevPageLink();
}

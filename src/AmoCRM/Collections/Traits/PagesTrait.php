<?php

namespace AmoCRM\Collections\Traits;

use AmoCRM\Collections\BaseApiCollection;

trait PagesTrait
{
    /**
     * @var null|string
     */
    private $nextPageLink;

    /**
     * @var null|string
     */
    private $prevPageLink;

    /**
     * @param string $url
     * @return PagesTrait
     */
    public function setNextPageLink($url)
    {
        $this->nextPageLink = $url;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getNextPageLink()
    {
        return $this->nextPageLink;
    }

    /**
     * @param string $url
     * @return PagesTrait
     */
    public function setPrevPageLink($url)
    {
        $this->prevPageLink = $url;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getPrevPageLink()
    {
        return $this->prevPageLink;
    }
}

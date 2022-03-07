<?php

namespace AmoCRM\Filters;

class WebhooksFilter extends BaseEntityFilter
{
    /**
     * @var string|null
     */
    private $destination;

    /**
     * @return string|null
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param string|null $destination
     *
     * @return WebhooksFilter
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * @return array
     */
    public function buildFilter()
    {
        $filter = [];

        if (!is_null($this->getDestination())) {
            $filter['filter']['destination'] = $this->getDestination();
        }

        return $filter;
    }
}

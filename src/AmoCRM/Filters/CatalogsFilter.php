<?php

namespace AmoCRM\Filters;

use function is_null;

class CatalogsFilter extends BaseEntityFilter
{
    /** @var null|string */
    private $type = null;

    /**
     * @param null|string $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function buildFilter()
    {
        $filter = [];

        if (!is_null($this->getType())) {
            $filter['type'] = $this->getType();
        }

        return $filter;
    }
}

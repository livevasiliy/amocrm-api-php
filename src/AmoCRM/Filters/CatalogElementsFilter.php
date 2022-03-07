<?php

namespace AmoCRM\Filters;

use AmoCRM\Filters\Interfaces\HasPagesInterface;
use AmoCRM\Filters\Traits\ArrayOrNumericFilterTrait;
use AmoCRM\Filters\Traits\PagesFilterTrait;

class CatalogElementsFilter extends BaseEntityFilter implements HasPagesInterface
{
    //todo support order and other fields
    use PagesFilterTrait;
    use ArrayOrNumericFilterTrait;

    /**
     * @var array|null
     */
    private $ids = null;

    /**
     * @var string|null
     */
    private $query = null;

    /**
     * @return null|array
     */
    public function getIds()
    {
        return $this->ids;
    }

    /**
     * @param array $ids
     * @return CatalogElementsFilter
     */
    public function setIds(array $ids)
    {
        $this->ids = $this->parseArrayOrNumberFilter($ids);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param string|null $query
     * @return CatalogElementsFilter
     */
    public function setQuery($query)
    {
        if (!empty($query)) {
            $this->query = (string)$query;
        }

        return $this;
    }

    /**
     * @return array
     */
    public function buildFilter()
    {
        $filter = [];

        if (!is_null($this->getIds())) {
            $filter['id'] = $this->getIds();
        }

        if (!is_null($this->getQuery())) {
            $filter['query'] = $this->getQuery();
        }

        $filter = $this->buildPagesFilter($filter);

        return $filter;
    }
}

<?php

namespace AmoCRM\Filters\Traits;

trait PagesFilterTrait
{
    /**
     * @var int
     */
    private $page = 1;

    /**
     * @var int
     */
    private $limit = 50;

    /**
     * @param int $page
     *
     * @return PagesFilterTrait
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param int $limit
     * @return PagesFilterTrait
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    protected function buildPagesFilter(array $filter = [])
    {
        if (!is_null($this->getLimit())) {
            $filter['limit'] = $this->getLimit();
        }

        if (!is_null($this->getPage())) {
            $filter['page'] = $this->getPage();
        }

        return $filter;
    }
}

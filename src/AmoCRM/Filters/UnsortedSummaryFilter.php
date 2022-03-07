<?php

namespace AmoCRM\Filters;

use AmoCRM\Filters\Traits\IntOrIntRangeFilterTrait;

class UnsortedSummaryFilter extends BaseEntityFilter
{
    use IntOrIntRangeFilterTrait;

    /**
     * @var array|int|null
     */
    private $createdAt = null;

    /**
     * @var int|null
     */
    private $pipelineId = null;

    /**
     * @return int|null
     */
    public function getPipelineId()
    {
        return $this->pipelineId;
    }

    /**
     * @param int|null $pipelineId
     * @return UnsortedSummaryFilter
     */
    public function setPipelineId($pipelineId)
    {
        $this->pipelineId = $pipelineId;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param BaseRangeFilter|int|null $createdAt
     * @return UnsortedSummaryFilter
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $this->parseIntOrIntRangeFilter($createdAt);

        return $this;
    }

    /**
     * @return array
     */
    public function buildFilter()
    {
        $filter = [];

        if (!is_null($this->getCreatedAt())) {
            $filter['filter']['created_at'] = $this->getCreatedAt();
        }

        if (!is_null($this->getPipelineId())) {
            $filter['filter']['pipeline_id'] = $this->getPipelineId();
        }

        return $filter;
    }
}

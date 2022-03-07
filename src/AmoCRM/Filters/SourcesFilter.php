<?php

namespace AmoCRM\Filters;

class SourcesFilter extends BaseEntityFilter
{
    /**
     * @var string[]|null
     */
    private $externalIds;

    /**
     * @return array|null
     */
    public function getExternalIds()
    {
        return $this->externalIds;
    }

    /**
     * @param string[]|null $externalIds
     *
     * @return SourcesFilter
     */
    public function setExternalIds($externalIds)
    {
        $this->externalIds = $externalIds;

        return $this;
    }

    /**
     * @return array
     */
    public function buildFilter()
    {
        $filter = [];

        if (!is_null($this->getExternalIds())) {
            $externalIds = $this->getExternalIds();

            if (count($externalIds) === 1) {
                $externalIds = reset($externalIds);
            }
            $filter['filter']['external_id'] = $externalIds;
        }

        return $filter;
    }
}

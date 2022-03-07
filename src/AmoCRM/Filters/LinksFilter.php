<?php

namespace AmoCRM\Filters;

class LinksFilter extends BaseEntityFilter
{
    /**
     * @var int|null
     */
    private $toEntityId = null;

    /**
     * @var string|null
     */
    private $toEntityType = null;

    /**
     * @var int|null
     */
    private $toCatalogId = null;

    /**
     * @return int|null
     */
    public function getToEntityId()
    {
        return $this->toEntityId;
    }

    /**
     * @param int|null $toEntityId
     *
     * @return LinksFilter
     */
    public function setToEntityId($toEntityId)
    {
        $this->toEntityId = $toEntityId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getToEntityType()
    {
        return $this->toEntityType;
    }

    /**
     * @param string|null $toEntityType
     *
     * @return LinksFilter
     */
    public function setToEntityType($toEntityType)
    {
        $this->toEntityType = $toEntityType;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getToCatalogId()
    {
        return $this->toCatalogId;
    }

    /**
     * @param int|null $toCatalogId
     *
     * @return LinksFilter
     */
    public function setToCatalogId($toCatalogId)
    {
        $this->toCatalogId = $toCatalogId;

        return $this;
    }

    /**
     * @return array
     */
    public function buildFilter()
    {
        $filter = [];

        if (!is_null($this->getToEntityId())) {
            $filter['filter']['to_entity_id'] = $this->getToEntityId();
        }

        if (!empty($this->getToEntityType())) {
            $filter['filter']['to_entity_type'] = $this->getToEntityType();
        }

        if (!empty($this->getToCatalogId())) {
            $filter['filter']['to_catalog_id'] = $this->getToCatalogId();
        }

        return $filter;
    }
}

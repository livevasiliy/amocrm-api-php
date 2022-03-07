<?php

namespace AmoCRM\Filters;

abstract class BaseEntityFilter
{
    /**
     * @return array
     */
    abstract public function buildFilter();
}

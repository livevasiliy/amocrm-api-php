<?php

namespace AmoCRM\EntitiesServices\Interfaces;

/**
 * Интерфейс для сервисов, у которых сущность имеет родительскую сущность
 * @package AmoCRM\EntitiesServices\Interfaces
 */
interface HasParentEntity
{
    const ID_KEY = 'id';
    const PARENT_ID_KEY = 'parent_id';
}

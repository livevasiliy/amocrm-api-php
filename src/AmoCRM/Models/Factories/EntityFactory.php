<?php

namespace AmoCRM\Models\Factories;

use AmoCRM\Exceptions\InvalidArgumentException;
use AmoCRM\Helpers\EntityTypesInterface;
use AmoCRM\Models\CatalogElementModel;
use AmoCRM\Models\CompanyModel;
use AmoCRM\Models\ContactModel;
use AmoCRM\Models\Customers\CustomerModel;
use AmoCRM\Models\LeadModel;
use AmoCRM\Models\TaskModel;

/**
 * Class EntityFactory
 *
 * @package AmoCRM\Models\Factories
 */
class EntityFactory
{
    /**
     * @param string $type
     * @param array $entity
     *
     * @return CatalogElementModel|CompanyModel|ContactModel|CustomerModel|LeadModel|TaskModel|null
     * @throws InvalidArgumentException
     */
    public static function createForType($type, array $entity)
    {
        switch ($type) {
            case 'lead':
            case EntityTypesInterface::LEADS:
                return LeadModel::fromArray($entity);
            case 'contact':
            case EntityTypesInterface::CONTACTS:
                return ContactModel::fromArray($entity);
            case 'company':
            case EntityTypesInterface::COMPANIES:
                return CompanyModel::fromArray($entity);
            case 'catalog_element':
            case EntityTypesInterface::CATALOG_ELEMENTS_FULL:
                return CatalogElementModel::fromArray($entity);
            case 'customer':
            case EntityTypesInterface::CUSTOMERS:
                return CustomerModel::fromArray($entity);
            case 'task':
            case EntityTypesInterface::TASKS:
                return TaskModel::fromArray($entity);
            default:
                return null;
        }
    }
}

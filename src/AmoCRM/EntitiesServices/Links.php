<?php

namespace AmoCRM\EntitiesServices;

use AmoCRM\Client\AmoCRMApiClient;
use AmoCRM\Client\AmoCRMApiRequest;
use AmoCRM\Collections\BaseApiCollection;
use AmoCRM\Collections\LinksCollection;
use AmoCRM\Exceptions\AmoCRMApiException;
use AmoCRM\Exceptions\AmoCRMoAuthApiException;
use AmoCRM\Exceptions\InvalidArgumentException;
use AmoCRM\Exceptions\NotAvailableForActionException;
use AmoCRM\Filters\BaseEntityFilter;
use AmoCRM\Helpers\EntityTypesInterface;
use AmoCRM\Models\BaseApiModel;
use AmoCRM\Models\LinkModel;

use function in_array;

class Links extends BaseEntityTypeEntity
{
    /** @var string */
    protected $method = 'api/v' . AmoCRMApiClient::API_VERSION . '/%s';

    /** @var string */
    protected $collectionClass = LinksCollection::class;

    /** @var string */
    const ITEM_CLASS = LinkModel::class;

    /**
     * @param BaseEntityFilter|null $filter
     * @param array $with
     *
     * @return BaseApiCollection|null
     * @throws AmoCRMApiException
     * @throws AmoCRMoAuthApiException
     */
    public function get(BaseEntityFilter $filter = null, array $with = [])
    {
        $queryParams = [];
        if ($filter instanceof BaseEntityFilter) {
            $queryParams = $filter->buildFilter();
        }

        $response = $this->request->get($this->getMethod() . '/' . EntityTypesInterface::LINKS, $queryParams);

        return $this->createCollection($response);
    }

    /**
     * @param  BaseApiCollection  $collection
     * @return BaseApiCollection
     * @throws AmoCRMApiException
     * @throws AmoCRMoAuthApiException
     * @throws \AmoCRM\Exceptions\AmoCRMApiNoContentException
     */
    public function add(BaseApiCollection $collection)
    {
        $this->request->post($this->getMethod() . '/link', $collection->toApi());

        return $collection;
    }

    /**
     * @param  BaseApiCollection  $collection
     * @return BaseApiCollection
     * @throws AmoCRMApiException
     * @throws AmoCRMoAuthApiException
     * @throws \AmoCRM\Exceptions\AmoCRMApiNoContentException
     */
    public function delete(BaseApiCollection $collection)
    {
        $this->request->post($this->getMethod() . '/unlink', $collection->toApi());

        return $collection;
    }

    /**
     * @param array $response
     *
     * @return array
     */
    protected function getEntitiesFromResponse(array $response)
    {
        return isset($response[AmoCRMApiRequest::EMBEDDED][EntityTypesInterface::LINKS]) ? $response[AmoCRMApiRequest::EMBEDDED][EntityTypesInterface::LINKS] : [];
    }

    /**
     * @param $id
     * @param  array  $with
     * @return BaseApiModel|null
     * @throws NotAvailableForActionException
     */
    public function getOne($id, array $with = [])
    {
        throw new NotAvailableForActionException('Method not available for this entity');
    }

    /**
     * @param  BaseApiModel  $model
     * @return BaseApiModel
     * @throws NotAvailableForActionException
     */
    public function addOne(BaseApiModel $model)
    {
        throw new NotAvailableForActionException('Method not available for this entity');
    }

    /**
     * @param  BaseApiCollection  $collection
     * @return BaseApiCollection
     * @throws NotAvailableForActionException
     */
    public function update(BaseApiCollection $collection)
    {
        throw new NotAvailableForActionException('Method not available for this entity');
    }

    /**
     * @param  BaseApiModel  $apiModel
     * @return BaseApiModel
     * @throws NotAvailableForActionException
     */
    public function updateOne(BaseApiModel $apiModel)
    {
        throw new NotAvailableForActionException('Method not available for this entity');
    }

    /**
     * @param  BaseApiModel  $apiModel
     * @param $with
     * @return BaseApiModel
     * @throws NotAvailableForActionException
     */
    public function syncOne(BaseApiModel $apiModel, $with = [])
    {
        throw new NotAvailableForActionException('Method not available for this entity');
    }

    /**
     * @param  string  $entityType
     * @return string
     * @throws InvalidArgumentException
     */
    protected function validateEntityType($entityType)
    {
        $availableEntities = [
            EntityTypesInterface::CONTACTS,
            EntityTypesInterface::LEADS,
            EntityTypesInterface::CUSTOMERS,
            EntityTypesInterface::COMPANIES,
        ];

        if (!in_array($entityType, $availableEntities, true)) {
            throw new InvalidArgumentException('Entity is not supported by this method');
        }

        return $entityType;
    }
}

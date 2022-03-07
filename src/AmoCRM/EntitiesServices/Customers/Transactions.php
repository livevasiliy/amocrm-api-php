<?php

namespace AmoCRM\EntitiesServices\Customers;

use AmoCRM\EntitiesServices\BaseEntity;
use AmoCRM\EntitiesServices\HasDeleteMethodInterface;
use AmoCRM\Filters\BaseEntityFilter;
use AmoCRM\Helpers\EntityTypesInterface;
use AmoCRM\Client\AmoCRMApiClient;
use AmoCRM\Client\AmoCRMApiRequest;
use AmoCRM\Collections\BaseApiCollection;
use AmoCRM\Collections\Customers\Transactions\TransactionsCollection;
use AmoCRM\Exceptions\AmoCRMApiException;
use AmoCRM\Exceptions\AmoCRMoAuthApiException;
use AmoCRM\Exceptions\NotAvailableForActionException;
use AmoCRM\Models\BaseApiModel;
use AmoCRM\Models\Customers\Transactions\TransactionModel;

/**
 * Class Transactions
 *
 * @package AmoCRM\EntitiesServices\Customers
 *
 * @method null|TransactionModel getOne($id, array $with = [])
 * @method null|TransactionsCollection get(BaseEntityFilter $filter = null, array $with = [])
 * @method TransactionModel syncOne(BaseApiModel $apiModel, $with = [])
 */
class Transactions extends BaseEntity implements HasDeleteMethodInterface
{
    /**
     * @var string
     */
    protected $method = 'api/v' . AmoCRMApiClient::API_VERSION . '/' . EntityTypesInterface::CUSTOMERS . '/' . EntityTypesInterface::CUSTOMERS_TRANSACTIONS;

    /**
     * @var string
     */
    protected $methodWithId = 'api/v' . AmoCRMApiClient::API_VERSION . '/' . EntityTypesInterface::CUSTOMERS . '/%s/' . EntityTypesInterface::CUSTOMERS_TRANSACTIONS;

    /**
     * @var int
     */
    protected $customerId;

    /**
     * @var bool
     */
    protected $accrueBonus = true;

    /**
     * @var string
     */
    protected $collectionClass = TransactionsCollection::class;

    /**
     * @var string
     */
    const ITEM_CLASS = TransactionModel::class;

    /**
     * @param int $customerId
     *
     * @return Transactions
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * @param bool $accrueBonus
     *
     * @return Transactions
     */
    public function setAccrueBonus($accrueBonus)
    {
        $this->accrueBonus = $accrueBonus;

        return $this;
    }

    /**
     * @param array $response
     *
     * @return array
     */
    protected function getEntitiesFromResponse(array $response)
    {
        $entities = [];

        if (isset($response[AmoCRMApiRequest::EMBEDDED]) && isset($response[AmoCRMApiRequest::EMBEDDED][EntityTypesInterface::CUSTOMERS_TRANSACTIONS])) {
            $entities = $response[AmoCRMApiRequest::EMBEDDED][EntityTypesInterface::CUSTOMERS_TRANSACTIONS];
        }

        return $entities;
    }

    /**
     * @param BaseApiCollection $collection
     * @param array $response
     *
     * @return BaseApiCollection
     */
    protected function processAdd(BaseApiCollection $collection, array $response)
    {
        return $this->processAction($collection, $response);
    }

    /**
     * @param BaseApiCollection $collection
     * @param array $response
     *
     * @return BaseApiCollection
     */
    protected function processAction(BaseApiCollection $collection, array $response)
    {
        $entities = $this->getEntitiesFromResponse($response);
        foreach ($entities as $entity) {
            if (array_key_exists('request_id', $entity)) {
                $initialEntity = $collection->getBy('requestId', $entity['request_id']);
                if (!empty($initialEntity)) {
                    $this->processModelAction($initialEntity, $entity);
                }
            }
        }

        return $collection;
    }

    /**
     * @param BaseApiModel|TransactionModel $apiModel
     * @param array $entity
     *
     * @return void
     */
    protected function processModelAction(BaseApiModel $apiModel, array $entity)
    {
        if (isset($entity['id'])) {
            $apiModel->setId($entity['id']);
        }

        if (array_key_exists('comment', $entity)) {
            $apiModel->setComment($entity['comment']);
        }

        if (array_key_exists('price', $entity)) {
            $apiModel->setPrice($entity['price']);
        }
    }

    /**
     * @return string
     * @throws NotAvailableForActionException
     */
    protected function getMethodWithId()
    {
        $id = $this->customerId;

        if (!$id) {
            throw new NotAvailableForActionException('You must call setCustomerId before this action');
        }

        return sprintf($this->methodWithId, $id);
    }

    /**
     * Добавление сщуности
     * @param BaseApiModel|TransactionModel $model
     *
     * @return BaseApiModel|TransactionModel
     * @throws AmoCRMApiException
     * @throws AmoCRMoAuthApiException
     */
    public function addOne(BaseApiModel $model)
    {
        $this->setCustomerId($model->getCustomerId());

        /** @var BaseApiCollection $collection */
        $collection = new $this->collectionClass();
        $collection->add($model);
        $collection = $this->add($collection);

        return $collection->first();
    }


    /**
     * Добавление коллекции сущностей
     * @param BaseApiCollection|TransactionsCollection $collection
     *
     * @return BaseApiCollection
     * @throws AmoCRMApiException
     * @throws AmoCRMoAuthApiException
     */
    public function add(BaseApiCollection $collection)
    {
        $response = $this->request->post($this->getMethodWithId(), $collection->toApi(), $this->getQueryParams());
        $collection = $this->processAdd($collection, $response);

        return $collection;
    }

    /**
     * @param BaseApiModel|TransactionModel $model
     *
     * @return bool
     * @throws AmoCRMApiException
     * @throws AmoCRMoAuthApiException
     */
    public function deleteOne(BaseApiModel $model)
    {
        $this->setCustomerId($model->getCustomerId());

        $result = $this->request->delete($this->getMethodWithId() . '/' . $model->getId());

        return $result['result'];
    }

    /**
     * @param BaseApiCollection $collection
     *
     * @return BaseApiCollection
     * @throws NotAvailableForActionException
     */
    public function update(BaseApiCollection $collection)
    {
        throw new NotAvailableForActionException('Method not available for this entity');
    }

    /**
     * @param BaseApiModel $collection
     *
     * @return BaseApiModel
     * @throws NotAvailableForActionException
     */
    public function updateOne(BaseApiModel $collection)
    {
        throw new NotAvailableForActionException('Method not available for this entity');
    }

    /**
     * @param BaseApiCollection $collection
     *
     * @return bool
     * @throws NotAvailableForActionException
     */
    public function delete(BaseApiCollection $collection)
    {
        throw new NotAvailableForActionException('This entity supports only deleteOne method');
    }

    /**
     * @return array
     */
    protected function getQueryParams()
    {
        return [
            'accrue_bonus' => $this->accrueBonus ? 'true' : 'false',
        ];
    }
}

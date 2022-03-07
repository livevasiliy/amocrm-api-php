<?php

namespace AmoCRM\EntitiesServices;

use AmoCRM\Models\TalkModel;
use AmoCRM\Models\Talks\TalkCloseActionModel;
use AmoCRM\Client\AmoCRMApiClient;
use AmoCRM\Client\AmoCRMApiRequest;
use AmoCRM\Collections\BaseApiCollection;
use AmoCRM\Exceptions\AmoCRMApiException;
use AmoCRM\Exceptions\AmoCRMoAuthApiException;
use AmoCRM\Exceptions\NotAvailableForActionException;
use AmoCRM\Filters\BaseEntityFilter;
use AmoCRM\Helpers\EntityTypesInterface;
use AmoCRM\Models\BaseApiModel;

/**
 * @method TalkModel|null getOne($id, array $with = [])
 */
class Talks extends BaseEntity
{
    const ITEM_CLASS = TalkModel::class;

    /** @var string */
    protected $method = 'api/v' . AmoCRMApiClient::API_VERSION . '/' . EntityTypesInterface::TALKS;

    /**
     * @param array $response
     *
     * @return array
     */
    protected function getEntitiesFromResponse(array $response)
    {
        return isset($response[AmoCRMApiRequest::EMBEDDED][EntityTypesInterface::TALKS]) ? $response[AmoCRMApiRequest::EMBEDDED][EntityTypesInterface::TALKS] : [];
    }

    /**
     * @param  BaseEntityFilter|null  $filter
     * @param  array  $with
     * @return BaseApiCollection|null
     * @throws NotAvailableForActionException
     */
    public function get(BaseEntityFilter $filter = null, array $with = [])
    {
        throw new NotAvailableForActionException('Method not available for this entity');
    }

    /**
     * @param BaseApiModel $model
     *
     * @return BaseApiModel
     * @throws NotAvailableForActionException
     */
    public function addOne(BaseApiModel $model)
    {
        throw new NotAvailableForActionException('Method not available for this entity');
    }

    /**
     * @param BaseApiCollection $collection
     *
     * @return BaseApiCollection
     * @throws NotAvailableForActionException
     */
    public function add(BaseApiCollection $collection)
    {
        throw new NotAvailableForActionException('Method not available for this entity');
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
     * @param BaseApiModel $apiModel
     *
     * @return BaseApiModel
     * @throws NotAvailableForActionException
     */
    public function updateOne(BaseApiModel $apiModel)
    {
        throw new NotAvailableForActionException('Method not available for this entity');
    }

    /**
     * @param BaseApiModel $apiModel
     * @param array $with
     *
     * @return BaseApiModel
     * @throws NotAvailableForActionException
     */
    public function syncOne(BaseApiModel $apiModel, $with = [])
    {
        throw new NotAvailableForActionException('Method not available for this entity');
    }

    /**
     * Закрыть беседу
     *
     * @param TalkCloseActionModel $closeAction
     *
     * @return void
     * @throws AmoCRMApiException
     * @throws AmoCRMoAuthApiException
     * @throws \AmoCRM\Exceptions\AmoCRMApiNoContentException
     */
    public function close(TalkCloseActionModel $closeAction)
    {
        $body = ['force_close' => $closeAction->isForceClose()];
        /** @noinspection UnusedFunctionResultInspection */
        $this->request->post($this->getMethod() . '/' . $closeAction->getTalkId() . '/close', $body);
    }
}

<?php

namespace AmoCRM\EntitiesServices;

use AmoCRM\Helpers\EntityTypesInterface;
use AmoCRM\Client\AmoCRMApiClient;
use AmoCRM\Client\AmoCRMApiRequest;
use AmoCRM\Collections\BaseApiCollection;
use AmoCRM\Collections\Widgets\WidgetsCollection;
use AmoCRM\EntitiesServices\Interfaces\HasPageMethodsInterface;
use AmoCRM\EntitiesServices\Traits\PageMethodsTrait;
use AmoCRM\Exceptions\AmoCRMApiException;
use AmoCRM\Exceptions\AmoCRMoAuthApiException;
use AmoCRM\Exceptions\NotAvailableForActionException;
use AmoCRM\Models\BaseApiModel;
use AmoCRM\Models\Widgets\WidgetModel;

/**
 * Class Widgets
 *
 * @package AmoCRM\EntitiesServices
 *
 * @method null|WidgetModel getOne($id, array $with = [])
 */
class Widgets extends BaseEntity implements HasPageMethodsInterface
{
    use PageMethodsTrait;

    /**
     * @var string
     */
    protected $method = 'api/v' . AmoCRMApiClient::API_VERSION . '/' . EntityTypesInterface::WIDGETS;

    /**
     * @var string
     */
    protected $collectionClass = WidgetsCollection::class;

    /**
     * @var string
     */
    const ITEM_CLASS = WidgetModel::class;

    /**
     * @param array $response
     *
     * @return array
     */
    protected function getEntitiesFromResponse(array $response)
    {
        $entities = [];

        if (isset($response[AmoCRMApiRequest::EMBEDDED]) && isset($response[AmoCRMApiRequest::EMBEDDED][EntityTypesInterface::WIDGETS])) {
            $entities = $response[AmoCRMApiRequest::EMBEDDED][EntityTypesInterface::WIDGETS];
        }

        return $entities;
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
     * Установка виджета
     *
     * @param WidgetModel $widgetModel
     *
     * @return WidgetModel
     * @throws AmoCRMApiException
     * @throws AmoCRMoAuthApiException
     */
    public function install(WidgetModel $widgetModel)
    {
        $response = $this->request->post(
            $this->getMethod() . '/' . $widgetModel->getCode(),
            $widgetModel->toApi()
        );

        foreach ($response as $key => $value) {
            $widgetModel->$key = $value;
        }

        return $widgetModel;
    }

    /**
     * Отключение виджета
     *
     * @param WidgetModel $widgetModel
     *
     * @return WidgetModel
     * @throws AmoCRMApiException
     * @throws AmoCRMoAuthApiException
     */
    public function uninstall(WidgetModel $widgetModel)
    {
        $response = $this->request->delete(
            $this->getMethod() . '/' . $widgetModel->getCode()
        );

        foreach ($response as $key => $value) {
            $widgetModel->$key = $value;
        }

        return $widgetModel;
    }
}

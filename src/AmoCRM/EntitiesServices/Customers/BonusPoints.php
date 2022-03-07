<?php

namespace AmoCRM\EntitiesServices\Customers;

use AmoCRM\Models\Customers\BonusPointsActionModel;
use AmoCRM\Client\AmoCRMApiClient;
use AmoCRM\Client\AmoCRMApiRequest;
use AmoCRM\Exceptions\AmoCRMApiException;
use AmoCRM\Exceptions\AmoCRMApiNoContentException;
use AmoCRM\Exceptions\AmoCRMoAuthApiException;
use AmoCRM\Helpers\EntityTypesInterface;

/**
 * Сервис для списания/начисления бонусных баллов покупателю
 *
 * @package AmoCRM\EntitiesServices\Customers
 */
class BonusPoints
{
    const BONUS_POINTS = 'bonus_points';
    const EARN_POINTS = 'earn';
    const REDEEM_POINTS = 'redeem';

    /** @var string */
    protected $method = 'api/v' . AmoCRMApiClient::API_VERSION . '/' . EntityTypesInterface::CUSTOMERS;

    /**
     * Определяет в наследниках, копит метод или тратит баллы
     * @var string
     */
    protected $pointsChangingMode = '';

    /**
     * @var AmoCRMApiRequest
     */
    protected $request;

    /**
     * BaseEntity constructor.
     *
     * @param AmoCRMApiRequest $request
     */
    public function __construct(AmoCRMApiRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Метод для начисления баллов покупателю
     *
     * @param BonusPointsActionModel $bonusPointsActionModel
     *
     * @return int|null
     * @throws AmoCRMApiException
     * @throws AmoCRMApiNoContentException
     * @throws AmoCRMoAuthApiException
     */
    public function earnPoints(BonusPointsActionModel $bonusPointsActionModel)
    {
        $response = $this->request->post(
            $this->getMethod($bonusPointsActionModel->getCustomerId()),
            [self::EARN_POINTS => $bonusPointsActionModel->getPoints()]
        );

        return isset($response['bonus_points']) ? $response['bonus_points'] : null;
    }

    /**
     * Метод для списания баллов покупателю
     *
     * @param BonusPointsActionModel $bonusPointsActionModel
     *
     * @return int|null
     * @throws AmoCRMApiException
     * @throws AmoCRMApiNoContentException
     * @throws AmoCRMoAuthApiException
     */
    public function redeemPoints(BonusPointsActionModel $bonusPointsActionModel)
    {
        $response = $this->request->post(
            $this->getMethod($bonusPointsActionModel->getCustomerId()),
            [self::REDEEM_POINTS => $bonusPointsActionModel->getPoints()]
        );

        return isset($response['bonus_points']) ? $response['bonus_points'] : null;
    }

    /**
     * @param int $customerId
     *
     * @return string
     */
    protected function getMethod($customerId)
    {
        return $this->method . '/' . $customerId . '/' . self::BONUS_POINTS;
    }
}

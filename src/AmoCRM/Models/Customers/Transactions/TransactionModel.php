<?php

namespace AmoCRM\Models\Customers\Transactions;

use AmoCRM\Client\AmoCRMApiRequest;
use AmoCRM\Collections\CatalogElementsCollection;
use AmoCRM\Models\BaseApiModel;
use AmoCRM\Models\CatalogElementModel;
use AmoCRM\Models\Customers\CustomerModel;
use AmoCRM\Models\Interfaces\HasIdInterface;
use AmoCRM\Models\Traits\RequestIdTrait;
use InvalidArgumentException;

/**
 * Class TransactionModel
 *
 * @package AmoCRM\Models\Customers\Transactions
 */
class TransactionModel extends BaseApiModel implements HasIdInterface
{
    use RequestIdTrait;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var int|null
     */
    protected $price;

    /**
     * @var int|null
     */
    protected $completedAt;

    /**
     * @var string|null
     */
    protected $comment;

    /**
     * @var null|int
     */
    protected $createdBy;

    /**
     * @var null|int
     */
    protected $updatedBy;

    /**
     * @var null|int
     */
    protected $createdAt;

    /**
     * @var null|int
     */
    protected $updatedAt;

    /**
     * @var CustomerModel|null
     */
    protected $customer;

    /**
     * @var int|null
     */
    protected $customerId;

    /**
     * @var bool|null
     */
    protected $idDeleted;

    /**
     * @var null|int
     */
    protected $accountId;

    /**
     * @var CatalogElementsCollection|null
     */
    protected $catalogElements;

    /**
     * @var int|null
     */
    protected $nextDate;

    /**
     * @var int|null
     */
    protected $nextPrice;

    /** @var string|null */
    protected $externalId;

    /** @var string|null */
    protected $receiptLink;

    /**
     * @param array $transaction
     *
     * @return self
     */
    public static function fromArray(array $transaction)
    {
        if (empty($transaction['id'])) {
            throw new InvalidArgumentException('Transaction id is empty in ' . json_encode($transaction));
        }

        $model = new self();

        $model->setId($transaction['id']);

        if (array_key_exists('price', $transaction) && !is_null($transaction['price'])) {
            $model->setPrice((int)$transaction['price']);
        }

        if (array_key_exists('completed_at', $transaction) && !is_null($transaction['completed_at'])) {
            $model->setCompletedAt((int)$transaction['completed_at']);
        }

        if (!empty($transaction['comment'])) {
            $model->setComment($transaction['comment']);
        }

        if (array_key_exists('created_by', $transaction) && !is_null($transaction['created_by'])) {
            $model->setCreatedBy((int)$transaction['created_by']);
        }

        if (array_key_exists('updated_by', $transaction) && !is_null($transaction['updated_by'])) {
            $model->setUpdatedBy((int)$transaction['updated_by']);
        }

        if (!empty($transaction['created_at'])) {
            $model->setCreatedAt($transaction['created_at']);
        }

        if (!empty($transaction['updated_at'])) {
            $model->setUpdatedAt($transaction['updated_at']);
        }

        if (!empty($transaction['account_id'])) {
            $model->setAccountId((int)$transaction['account_id']);
        }

        if (array_key_exists('is_deleted', $transaction) && !is_null($transaction['is_deleted'])) {
            $model->setIdDeleted((bool)$transaction['is_deleted']);
        }

        if (array_key_exists('customer_id', $transaction) && !is_null($transaction['customer_id'])) {
            $customerModel = new CustomerModel();
            $customerModel->setId($transaction['customer_id']);
            $model->setCustomer($customerModel);

            $model->setCustomerId($transaction['customer_id']);
        }

        if (!empty($transaction[AmoCRMApiRequest::EMBEDDED]['catalog_elements'])) {
            $catalogElementsCollection = new CatalogElementsCollection();
            foreach ($transaction[AmoCRMApiRequest::EMBEDDED]['catalog_elements'] as $catalogElement) {
                $catalogElementModel = new CatalogElementModel();
                $catalogElementModel
                    ->setId($catalogElement['id'])
                    ->setCatalogId($catalogElement['metadata']['catalog_id'])
                    ->setQuantity(
                        isset($catalogElement['metadata']['quantity']) ? $catalogElement['metadata']['quantity'] : 1
                    );
                $catalogElementsCollection->add($catalogElementModel);
            }

            $model->setCatalogElements($catalogElementsCollection);
        }

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'price' => $this->getPrice(),
            'completed_at' => $this->getCompletedAt(),
            'comment' => $this->getComment(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
            'created_by' => $this->getCreatedBy(),
            'updated_by' => $this->getUpdatedBy(),
            'is_deleted' => $this->getIdDeleted(),
            'account_id' => $this->getAccountId(),
            'catalog_elements' => $this->getCatalogElements() ? $this->getCatalogElements()->toArray() : null,
            'customer_id' => $this->getCustomerId(),
            'customer' =>  $this->getCustomer()->toArray(),
        ];
    }

    /**
     * @return null|int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return TransactionModel
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param int|null $price
     *
     * @return TransactionModel
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCompletedAt()
    {
        return $this->completedAt;
    }

    /**
     * @param int|null $completedAt
     *
     * @return TransactionModel
     */
    public function setCompletedAt($completedAt)
    {
        $this->completedAt = $completedAt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string|null $comment
     *
     * @return TransactionModel
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param int|null $createdBy
     *
     * @return TransactionModel
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * @param int|null $updatedBy
     *
     * @return TransactionModel
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param int|null $createdAt
     *
     * @return TransactionModel
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param int|null $updatedAt
     *
     * @return TransactionModel
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return CustomerModel|null
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param CustomerModel|null $customer
     *
     * @return TransactionModel
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIdDeleted()
    {
        return $this->idDeleted;
    }

    /**
     * @param bool|null $idDeleted
     *
     * @return TransactionModel
     */
    public function setIdDeleted($idDeleted)
    {
        $this->idDeleted = $idDeleted;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @param int|null $accountId
     *
     * @return TransactionModel
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @param int|null $customerId
     *
     * @return TransactionModel
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * @return CatalogElementsCollection|null
     */
    public function getCatalogElements()
    {
        return $this->catalogElements;
    }

    /**
     * @param CatalogElementsCollection|null $catalogElements
     *
     * @return TransactionModel
     */
    public function setCatalogElements($catalogElements)
    {
        $this->catalogElements = $catalogElements;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getNextDate()
    {
        return $this->nextDate;
    }

    /**
     * @param int|null $nextDate
     *
     * @return TransactionModel
     */
    public function setNextDate($nextDate)
    {
        $this->nextDate = $nextDate;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getNextPrice()
    {
        return $this->nextPrice;
    }

    /**
     * @param int|null $nextPrice
     *
     * @return TransactionModel
     */
    public function setNextPrice($nextPrice)
    {
        $this->nextPrice = $nextPrice;

        return $this;
    }

    /**
     * @param string|null $requestId
     *
     * @return array
     */
    public function toApi($requestId = "0")
    {
        $result = [
            'price' => $this->getPrice(),
        ];

        if (!is_null($this->getCompletedAt())) {
            $result['completed_at'] = $this->getCompletedAt();
        }

        if (!is_null($this->getComment())) {
            $result['comment'] = $this->getComment();
        }

        if (!is_null($this->getCatalogElements())) {
            $catalogElements = [];
            /** @var CatalogElementModel $catalogElement */
            foreach ($this->getCatalogElements() as $catalogElement) {
                $catalogElements[] = [
                    'id' => $catalogElement->getId(),
                    'metadata' => [
                        'catalog_id' => $catalogElement->getCatalogId(),
                        'quantity' => $catalogElement->getQuantity() !== null ? $catalogElement->getQuantity() : 1,
                    ]
                ];
            }

            $result[AmoCRMApiRequest::EMBEDDED]['catalog_elements'] = $catalogElements;
        }

        if (!is_null($this->getNextDate())) {
            $result['next_date'] = $this->getNextDate();
        }

        if (!is_null($this->getNextPrice())) {
            $result['next_price'] = $this->getNextPrice();
        }

        if (!is_null($this->getReceiptLink())) {
            $result['metadata'] = isset($result['metadata']) ? $result['metadata'] : [];
            $result['metadata']['receipt_link'] = $this->getReceiptLink();
        }

        if (!is_null($this->getExternalId())) {
            $result['metadata'] = isset($result['metadata']) ? $result['metadata'] : [];
            $result['metadata']['external_id'] = $this->getExternalId();
        }

        if (is_null($this->getRequestId()) && !is_null($requestId)) {
            $this->setRequestId($requestId);
        }

        $result['request_id'] = (string)$this->getRequestId();

        return $result;
    }

    /**
     * @return string|null
     */
    public function getReceiptLink()
    {
        return $this->receiptLink;
    }

    /**
     * @param string|null $receiptLink
     * @return TransactionModel
     */
    public function setReceiptLink($receiptLink)
    {
        $this->receiptLink = $receiptLink;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getExternalId()
    {
        return $this->externalId;
    }

    /**
     * @param string|null $externalId
     * @return TransactionModel
     */
    public function setExternalId($externalId)
    {
        $this->externalId = $externalId;

        return $this;
    }
}

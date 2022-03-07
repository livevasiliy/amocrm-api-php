<?php

namespace AmoCRM\Models;

use AmoCRM\Exceptions\InvalidArgumentException;
use AmoCRM\Helpers\EntityTypesInterface;
use AmoCRM\Models\Interfaces\CanBeLinkedInterface;
use AmoCRM\Models\Interfaces\HasIdInterface;
use AmoCRM\Models\Interfaces\TypeAwareInterface;
use AmoCRM\Models\Traits\GetLinkTrait;
use AmoCRM\Collections\CustomFieldsValuesCollection;
use AmoCRM\Models\Traits\RequestIdTrait;

use function is_null;

class CatalogElementModel extends BaseApiModel implements TypeAwareInterface, CanBeLinkedInterface, HasIdInterface
{
    use RequestIdTrait;
    use GetLinkTrait;

    /** @var string Ссылка на печатную форму счета с возможностью оплаты */
    const INVOICE_LINK = 'invoice_link';

    /**
     * @var int|null
     */
    protected $id;

    /**
     * @var null|string
     */
    protected $name;

    /**
     * @var int
     */
    protected $catalogId;

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
     * @var CustomFieldsValuesCollection|null
     */
    protected $customFieldsValues;

    /**
     * @var bool|null
     */
    protected $isDeleted;

    /**
     * @var int|null
     */
    protected $quantity;

    /**
     * ID поля типа цена, используется в метаданных при привязке к сущности
     *
     * @var int|null
     */
    protected $priceId;

    /**
     * @var int|null
     */
    protected $accountId;

    /**
     * Доступен только в каталоге счетов
     *
     * @var string|null
     */
    protected $invoiceLink;

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
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return null|int
     */
    public function getCatalogId()
    {
        return $this->catalogId;
    }

    /**
     * @param null|int $id
     *
     * @return self
     */
    public function setCatalogId($id)
    {
        $this->catalogId = $id;

        return $this;
    }

    /**
     * @return null|int
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param null|int $userId
     *
     * @return self
     */
    public function setCreatedBy($userId)
    {
        $this->createdBy = $userId;

        return $this;
    }

    /**
     * @return null|int
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * @param null|int $userId
     *
     * @return self
     */
    public function setUpdatedBy($userId)
    {
        $this->updatedBy = $userId;

        return $this;
    }

    /**
     * @return null|int
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param null|int $timestamp
     *
     * @return self
     */
    public function setCreatedAt($timestamp)
    {
        $this->createdAt = $timestamp;

        return $this;
    }

    /**
     * @return null|int
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param null|int $timestamp
     *
     * @return self
     */
    public function setUpdatedAt($timestamp)
    {
        $this->updatedAt = $timestamp;

        return $this;
    }

    /**
     * @return null|bool
     */
    public function getIsDeleted()
    {
        return $this->isDeleted;
    }

    /**
     * @param null|bool $flag
     *
     * @return self
     */
    public function setIsDeleted($flag)
    {
        $this->isDeleted = $flag;

        return $this;
    }

    /**
     * @return CustomFieldsValuesCollection|null
     */
    public function getCustomFieldsValues()
    {
        return $this->customFieldsValues;
    }

    /**
     * @param CustomFieldsValuesCollection|null $values
     *
     * @return self
     */
    public function setCustomFieldsValues($values)
    {
        $this->customFieldsValues = $values;

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
     * @return CatalogElementModel
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;

        return $this;
    }

    public function getType()
    {
        return EntityTypesInterface::CATALOG_ELEMENTS_FULL;
    }

    /**
     * @return string|null
     */
    public function getInvoiceLink()
    {
        return $this->invoiceLink;
    }

    /**
     * @param string|null $invoiceLink
     *
     * @return CatalogElementModel
     */
    public function setInvoiceLink($invoiceLink)
    {
        $this->invoiceLink = $invoiceLink;

        return $this;
    }

    /**
     * @param array $catalogElement
     *
     * @return self
     * @throws InvalidArgumentException
     */
    public static function fromArray(array $catalogElement)
    {
        if (empty($catalogElement['id'])) {
            throw new InvalidArgumentException('Catalog id is empty in ' . json_encode($catalogElement));
        }

        $catalogElementModel = new self();

        $catalogElementModel->setId((int)$catalogElement['id']);

        if (!empty($catalogElement['name'])) {
            $catalogElementModel->setName($catalogElement['name']);
        }
        if (array_key_exists('created_by', $catalogElement) && !is_null($catalogElement['created_by'])) {
            $catalogElementModel->setCreatedBy((int)$catalogElement['created_by']);
        }
        if (array_key_exists('updated_by', $catalogElement) && !is_null($catalogElement['updated_by'])) {
            $catalogElementModel->setUpdatedBy((int)$catalogElement['updated_by']);
        }
        if (!empty($catalogElement['created_at'])) {
            $catalogElementModel->setCreatedAt($catalogElement['created_at']);
        }
        if (!empty($catalogElement['updated_at'])) {
            $catalogElementModel->setUpdatedAt($catalogElement['updated_at']);
        }
        if (!empty($catalogElement['catalog_id'])) {
            $catalogElementModel->setCatalogId($catalogElement['catalog_id']);
        }
        if (array_key_exists('is_deleted', $catalogElement) && !is_null($catalogElement['is_deleted'])) {
            $catalogElementModel->setIsDeleted($catalogElement['is_deleted']);
        }

        if (array_key_exists('invoice_link', $catalogElement) && !is_null($catalogElement['invoice_link'])) {
            $catalogElementModel->setInvoiceLink($catalogElement['invoice_link']);
        }
        if (!empty($catalogElement['custom_fields_values'])) {
            $valuesCollection = new CustomFieldsValuesCollection();
            $customFieldsValues = $valuesCollection->fromArray($catalogElement['custom_fields_values']);
            $catalogElementModel->setCustomFieldsValues($customFieldsValues);
        }

        //Костылик для связей
        if (isset($catalogElement['to_element_id'])) {
            $catalogElementModel->setId($catalogElement['to_element_id']);
        }
        if (isset($catalogElement['metadata']['quantity'])) {
            $catalogElementModel->setQuantity($catalogElement['metadata']['quantity']);
        }
        if (isset($catalogElement['metadata']['price_id'])) {
            $catalogElementModel->setPriceId($catalogElement['metadata']['price_id']);
        }
        if (isset($catalogElement['metadata']['catalog_id'])) {
            $catalogElementModel->setCatalogId($catalogElement['metadata']['catalog_id']);
        }

        if (!empty($catalog['account_id'])) {
            $catalogElementModel->setAccountId((int)$catalog['account_id']);
        }

        return $catalogElementModel;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'id'   => $this->getId(),
            'name' => $this->getName(),
            'created_by' => $this->getCreatedBy(),
            'updated_by' => $this->getUpdatedBy(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
            'catalog_id' => $this->getCatalogId(),
            'is_deleted' => $this->getIsDeleted(),
            'custom_fields_values' => is_null($this->getCustomFieldsValues())
                ? null
                : $this->getCustomFieldsValues()->toArray(),
            'account_id' => $this->getAccountId(),
            'invoice_link' => $this->getInvoiceLink(),
            'metadata'   => [
                'quantity' => $this->getQuantity(),
                'catalog_id' => $this->getCatalogId(),
                'price_id' => $this->getPriceId(),
            ]
        ];
    }

    public function toApi($requestId = "0")
    {
        $result = [];

        if (!is_null($this->getId())) {
            $result['id'] = $this->getId();
        }

        if (!is_null($this->getName())) {
            $result['name'] = $this->getName();
        }

        if (!is_null($this->getCreatedBy())) {
            $result['created_by'] = $this->getCreatedBy();
        }

        if (!is_null($this->getUpdatedBy())) {
            $result['updated_by'] = $this->getUpdatedBy();
        }

        if (!is_null($this->getCreatedAt())) {
            $result['created_at'] = $this->getCreatedAt();
        }

        if (!is_null($this->getCustomFieldsValues())) {
            $result['custom_fields_values'] = $this->getCustomFieldsValues()->toApi();
        }

        if (is_null($this->getRequestId()) && !is_null($requestId)) {
            $this->setRequestId($requestId);
        }

        $result['request_id'] = $this->getRequestId();

        return $result;
    }

    /**
     * @return int|float|null
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int|float $quantity
     *
     * @return CatalogElementModel
     * @throws InvalidArgumentException
     */
    public function setQuantity($quantity)
    {
        if (is_int($quantity) || is_float($quantity)) {
            $this->quantity = $quantity;
        } else {
            throw new InvalidArgumentException('Quantity must be integer or float number');
        }

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPriceId()
    {
        return $this->priceId;
    }

    /**
     * @param int|null $priceId
     *
     * @return CatalogElementModel
     */
    public function setPriceId($priceId)
    {
        $this->priceId = $priceId;

        return $this;
    }

    /**
     * @return array|null
     */
    protected function getMetadataForLink()
    {
        $result = null;

        if (!is_null($this->getUpdatedBy())) {
            $result['updated_by'] = $this->getUpdatedBy();
        }

        if (!is_null($this->getQuantity())) {
            $result['quantity'] = $this->getQuantity();
        }

        $result['price_id'] = $this->getPriceId();

        if (!is_null($this->getCatalogId())) {
            $result['catalog_id'] = $this->getCatalogId();
        }

        return $result;
    }

    /**
     * @return array
     */
    public static function getAvailableWith()
    {
        return [
            self::INVOICE_LINK,
        ];
    }
}

<?php

namespace AmoCRM\Models\CustomFieldsValues\ValueModels;

/**
 * Class LegalEntityCustomFieldValueModel
 *
 * @package AmoCRM\Models\CustomFieldsValues\ValueModels
 */
class LegalEntityCustomFieldValueModel extends BaseArrayCustomFieldValueModel
{
    /** Имя юр лицы */
    const NAME = 'name';
    /** Тип юр лица */
    const LEGAL_ENTITY_TYPE = 'entity_type';
    /** ИНН */
    const VAT_ID = 'vat_id';
    /** ОГРН/ОГРНИП */
    const TAX_REG_REASON_CODE = 'tax_registration_reason_code';
    /** Адрес юр лица */
    const ADDRESS = 'address';
    /** КПП */
    const KPP = 'kpp';
    /** БИК */
    const BANK_CODE = 'bank_code';
    /** Идентификатор юр лица во внешней учетной системе */
    const EXTERNAL_UID = 'external_uid';

    /** Частное лицо */
    const LEGAL_ENTITY_TYPE_SOLE_PROPRIETORSHIP = 1;
    /** Юр. лицо */
    const LEGAL_ENTITY_TYPE_JURIDICAL_PERSON = 2;

    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var int|null
     */
    protected $legalEntityType;

    /**
     * @var string|null
     */
    protected $vatId;

    /**
     * @var string|null
     */
    protected $taxRegistrationReasonCode;

    /**
     * @var string|null
     */
    protected $address;

    /**
     * @var string|null
     */
    protected $kpp;

    /**
     * @var string|null
     */
    protected $bankCode;

    /**
     * @var string|null
     */
    protected $externalUid;

    /**
     * @param array|null $value
     *
     * @return BaseCustomFieldValueModel
     */
    public static function fromArray($value)
    {
        $model = new static();

        $model
            ->setName(isset($value['value'][self::NAME]) ? $value['value'][self::NAME] : null)
            ->setLegalEntityType(
                isset($value['value'][self::LEGAL_ENTITY_TYPE]) ? $value['value'][self::LEGAL_ENTITY_TYPE] : null
            )
            ->setVatId(isset($value['value'][self::VAT_ID]) ? $value['value'][self::VAT_ID] : null)
            ->setTaxRegistrationReasonCode(
                isset($value['value'][self::TAX_REG_REASON_CODE]) ? $value['value'][self::TAX_REG_REASON_CODE] : null
            )
            ->setAddress(isset($value['value'][self::ADDRESS]) ? $value['value'][self::ADDRESS] : null)
            ->setKpp(isset($value['value'][self::KPP]) ? $value['value'][self::KPP] : null)
            ->setBankCode(isset($value['value'][self::BANK_CODE]) ? $value['value'][self::BANK_CODE] : null)
            ->setExternalUid(isset($value['value'][self::EXTERNAL_UID]) ? $value['value'][self::EXTERNAL_UID] : null)
        ;

        return $model;
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     *
     * @return LegalEntityCustomFieldValueModel
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getLegalEntityType()
    {
        return $this->legalEntityType;
    }

    /**
     * @param int|null $legalEntityType
     *
     * @return LegalEntityCustomFieldValueModel
     */
    public function setLegalEntityType($legalEntityType)
    {
        $this->legalEntityType = $legalEntityType;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getVatId()
    {
        return $this->vatId;
    }

    /**
     * @param string|null $vatId
     *
     * @return LegalEntityCustomFieldValueModel
     */
    public function setVatId($vatId)
    {
        $this->vatId = $vatId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTaxRegistrationReasonCode()
    {
        return $this->taxRegistrationReasonCode;
    }

    /**
     * @param string|null $taxRegistrationReasonCode
     *
     * @return LegalEntityCustomFieldValueModel
     */
    public function setTaxRegistrationReasonCode($taxRegistrationReasonCode)
    {
        $this->taxRegistrationReasonCode = $taxRegistrationReasonCode;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     *
     * @return LegalEntityCustomFieldValueModel
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getKpp()
    {
        return $this->kpp;
    }

    /**
     * @param string|null $kpp
     *
     * @return LegalEntityCustomFieldValueModel
     */
    public function setKpp($kpp)
    {
        $this->kpp = $kpp;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBankCode()
    {
        return $this->bankCode;
    }

    /**
     * @param string|null $bankCode
     *
     * @return LegalEntityCustomFieldValueModel
     */
    public function setBankCode($bankCode)
    {
        $this->bankCode = $bankCode;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getExternalUid()
    {
        return $this->externalUid;
    }

    /**
     * @param string|null $externalUid
     *
     * @return LegalEntityCustomFieldValueModel
     */
    public function setExternalUid($externalUid)
    {
        $this->externalUid = $externalUid;

        return $this;
    }

    public function toArray()
    {
        return [
            self::NAME => $this->getName(),
            self::LEGAL_ENTITY_TYPE => $this->getLegalEntityType(),
            self::VAT_ID => $this->getVatId(),
            self::TAX_REG_REASON_CODE => $this->getTaxRegistrationReasonCode(),
            self::ADDRESS => $this->getAddress(),
            self::KPP => $this->getKpp(),
            self::BANK_CODE => $this->getBankCode(),
            self::EXTERNAL_UID => $this->getExternalUid(),
        ];
    }

    /**
     * @return array
     */
    public function getValue()
    {
        return $this->toArray();
    }

    public function toApi($requestId = null)
    {
        return [
            'value' => $this->getValue(),
        ];
    }
}

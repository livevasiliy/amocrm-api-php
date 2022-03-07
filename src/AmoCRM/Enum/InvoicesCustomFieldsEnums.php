<?php

namespace AmoCRM\Enum;

class InvoicesCustomFieldsEnums
{
    /**
     * Ниже представлены константы с кодами полей списка счетов, которые есть во всех новых списках.
     * Важно отметить, что поля могут быть удалены из интерфейса!
     */
    /** @var string Статус счета */
    const STATUS = 'BILL_STATUS';
    /** @var string Юр.лицо */
    const LEGAL_ENTITY = 'LEGAL_ENTITY';
    /** @var string Плательщик */
    const PAYER = 'PAYER';
    /** @var string Позиции счета */
    const ITEMS = 'ITEMS';
    /** @var string Тип НДС */
    const VAT_TYPE = 'BILL_VAT_TYPE';
    /** @var string Дата оплаты */
    const PAYMENT_DATE = 'BILL_PAYMENT_DATE';
    /** @var string Комментарий */
    const COMMENT = 'BILL_COMMENT';
    /** @var string Итоговая сумма к оплате */
    const PRICE = 'BILL_PRICE';

    /** @var string Код значения "Не облагается НДС" поля Тип НДС */
    const VAT_EXEMPT = 'vat_exempt';
    /** @var string Код значения "НДС входит в стоимость" поля Тип НДС */
    const VAT_INCLUDED = 'vat_included';
    /** @var string Код значения "НДС начисляется поверх стоимости" поля Тип НДС */
    const VAT_NOT_INCLUDED = 'vat_not_included';

    /** @var string Код значения "Оплачен" поля Статус счета */
    const BILL_STATUS_PAID = 'paid';
    /** @var string Код значения "Создан" поля Статус счета */
    const BILL_STATUS_CREATED = 'created';
}

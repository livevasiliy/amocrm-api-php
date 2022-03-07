<?php

namespace AmoCRM\Models\NoteType;

use AmoCRM\Models\Factories\NoteFactory;
use AmoCRM\Exceptions\NotAvailableForActionException;
use AmoCRM\Models\NoteModel;

class TransactionNote extends NoteModel
{
    protected $modelClass = TransactionNote::class;

    /**
     * @var null|int
     */
    protected $transactionId;

    public function getNoteType()
    {
        return NoteFactory::NOTE_TYPE_CODE_TRANSACTION;
    }

    /**
     * @param array $note
     *
     * @return NoteModel
     */
    public function fromArray(array $note)
    {
        $model = parent::fromArray($note);

        if (isset($note['params']['transaction_id'])) {
            $model->setTransactionId($note['params']['transaction_id']);
        }

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        $result = parent::toArray();

        $result['params']['transaction_id'] = $this->getTransactionId();

        return $result;
    }

    /**
     * @param string|null $requestId
     * @return array
     * @throws NotAvailableForActionException
     */
    public function toApi($requestId = "0")
    {
        throw new NotAvailableForActionException();
    }

    /**
     * @return int|null
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * @param int|null $transactionId
     * @return TransactionNote
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;

        return $this;
    }
}

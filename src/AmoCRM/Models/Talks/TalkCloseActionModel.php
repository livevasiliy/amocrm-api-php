<?php

namespace AmoCRM\Models\Talks;

/**
 * Модель для закрытия беседы
 */
class TalkCloseActionModel
{
    /** @var int */
    protected $talkId;
    /**
     * Если выставлен true - закрыть беседу без запуска NPS-бота
     *
     * @var bool
     */
    protected $forceClose = false;

    /**
     * @param int $talkId
     * @param bool $forceClose
     */
    public function __construct($talkId, $forceClose = false)
    {
        $this->talkId = $talkId;
        $this->forceClose = $forceClose;
    }

    public function getTalkId()
    {
        return $this->talkId;
    }

    public function setTalkId($talkId)
    {
        $this->talkId = $talkId;

        return $this;
    }

    public function isForceClose()
    {
        return $this->forceClose;
    }

    public function setForceClose($forceClose)
    {
        $this->forceClose = $forceClose;

        return $this;
    }
}

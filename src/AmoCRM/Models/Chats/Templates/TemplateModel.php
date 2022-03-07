<?php

namespace AmoCRM\Models\Chats\Templates;

use AmoCRM\Collections\Chats\Templates\Buttons\ButtonsCollection;
use AmoCRM\Models\BaseApiModel;
use AmoCRM\Models\Interfaces\HasIdInterface;
use AmoCRM\Models\Traits\RequestIdTrait;

use function is_array;

/**
 * Class TemplateModel
 *
 * @package AmoCRM\Models\Chats\Templates
 */
class TemplateModel extends BaseApiModel implements HasIdInterface
{
    use RequestIdTrait;

    /**
     * @var int|null
     */
    protected $id;

    /**
     * @var int|null
     */
    protected $accountId;

    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var string|null
     */
    protected $content;

    /**
     * @var ButtonsCollection
     */
    protected $buttons;

    /**
     * @var int|null
     */
    protected $createdAt;

    /**
     * @var int|null
     */
    protected $updatedAt;

    /**
     * @var bool|null
     */
    protected $isEditable;

    /**
     * @var string|null
     */
    protected $externalId;

    /**
     * @param array $template
     *
     * @return self
     */
    public static function fromArray(array $template)
    {
        $model = new static();

        if (isset($template['id'])) {
            $model->setId($template['id']);
        }

        if (isset($template['account_id'])) {
            $model->setAccountId($template['account_id']);
        }

        if (isset($template['name'])) {
            $model->setName($template['name']);
        }

        if (isset($template['content'])) {
            $model->setContent($template['content']);
        }

        if (isset($template['created_at'])) {
            $model->setCreatedAt($template['created_at']);
        }

        if (isset($template['updated_at'])) {
            $model->setUpdatedAt($template['updated_at']);
        }

        if (isset($template['is_editable'])) {
            $model->setIsEditable((bool)$template['is_editable']);
        }

        if (isset($template['external_id'])) {
            $model->setExternalId($template['external_id']);
        }

        $buttonsCollection = isset($template['buttons']) && !empty($template['buttons']) && is_array($template['buttons'])
            ? ButtonsCollection::fromArray($template['buttons'])
            : new ButtonsCollection();

        $model->setButtons($buttonsCollection);

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'account_id' => $this->getAccountId(),
            'name' => $this->getName(),
            'content' => $this->getContent(),
            'buttons' => $this->getButtons() ? $this->getButtons()->toArray() : null,
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
            'is_editable' => $this->getIsEditable(),
            'external_id' => $this->getExternalId(),
            'request_id' => $this->getRequestId(),
        ];
    }

    /**
     * @param string|null $requestId
     * @return array
     */
    public function toApi($requestId = "0")
    {
        if (is_null($this->getRequestId()) && !is_null($requestId)) {
            $this->setRequestId($requestId);
        }

        return [
            'name' => $this->getName(),
            'content' => $this->getContent(),
            'buttons' => $this->getButtons() ? $this->getButtons()->toApi() : null,
            'is_editable' => $this->getIsEditable(),
            'external_id' => $this->getExternalId(),
            'request_id' => $this->getRequestId(),
        ];
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     *
     * @return TemplateModel
     */
    public function setId($id)
    {
        $this->id = $id;

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
     * @return TemplateModel
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;

        return $this;
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
     * @return TemplateModel
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     *
     * @return TemplateModel
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return ButtonsCollection|null
     */
    public function getButtons()
    {
        return $this->buttons;
    }

    /**
     * @param ButtonsCollection|null $buttons
     *
     * @return TemplateModel
     */
    public function setButtons($buttons)
    {
        $this->buttons = $buttons;

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
     * @return TemplateModel
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
     * @return TemplateModel
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsEditable()
    {
        return $this->isEditable;
    }

    /**
     * @param bool|null $isEditable
     *
     * @return TemplateModel
     */
    public function setIsEditable($isEditable)
    {
        $this->isEditable = $isEditable;

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
     *
     * @return TemplateModel
     */
    public function setExternalId($externalId)
    {
        $this->externalId = $externalId;

        return $this;
    }
}

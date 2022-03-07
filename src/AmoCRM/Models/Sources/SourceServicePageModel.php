<?php

namespace AmoCRM\Models\Sources;

use AmoCRM\Models\BaseApiModel;
use Illuminate\Contracts\Support\Arrayable;

class SourceServicePageModel extends BaseApiModel implements Arrayable
{
    /**
     * @var string
     */
    protected $id = '';

    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var string
     */
    protected $link = '';

    public static function fromArray(array $data)
    {
        $page = new static();

        $page->setId(isset($data['id']) ? $data['id'] : '');
        $page->setName(isset($data['name']) ? $data['name'] : '');
        $page->setLink(isset($data['link']) ? $data['link'] : '');

        return $page;
    }

    public function toArray()
    {
        return [
            'id'   => $this->getId(),
            'name' => $this->getName(),
            'link' => $this->getLink(),
        ];
    }

    public function toApi($requestId = null)
    {
        return $this->toArray();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param  string  $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param  string  $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param  string  $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }
}

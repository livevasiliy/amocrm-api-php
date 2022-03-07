<?php

namespace AmoCRM\Models\Sources;

use AmoCRM\Collections\Sources\SourceServicesPagesCollection;
use AmoCRM\Models\BaseApiModel;
use Illuminate\Contracts\Support\Arrayable;

class SourceServiceModel extends BaseApiModel implements Arrayable
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var SourceServicesPagesCollection|null
     */
    protected $pages;


    public static function fromArray(array $data)
    {
        $service = new static();

        $service->setType(isset($data['type']) ? $data['type'] : '');
        $service->setPages(SourceServicesPagesCollection::fromArray((array)(isset($data['pages']) ? $data['pages'] : [])));

        return $service;
    }

    public function toArray()
    {
        return [
            'type'  => $this->getType(),
            'pages' => $this->getPages()->toArray(),
        ];
    }

    public function toApi($requestId = null)
    {
        return $this->toArray();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param  string  $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return \AmoCRM\Collections\Sources\SourceServicesPagesCollection
     */
    public function getPages()
    {
        if (is_null($this->pages)) {
            $this->pages = new SourceServicesPagesCollection();
        }

        return $this->pages;
    }

    /**
     * @param  \AmoCRM\Collections\Sources\SourceServicesPagesCollection  $pages
     */
    public function setPages(SourceServicesPagesCollection $pages)
    {
        $this->pages = $pages;
    }
}

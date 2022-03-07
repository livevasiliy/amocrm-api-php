<?php

namespace AmoCRM\Models\Unsorted;

use AmoCRM\Models\Unsorted\Interfaces\UnsortedMetadataInterface;
use AmoCRM\Exceptions\BadTypeException;

class FormUnsortedModel extends BaseUnsortedModel
{
    /**
     * @var string
     */
    protected $category = BaseUnsortedModel::CATEGORY_CODE_FORMS;

    /**
     * @param string $category
     * @return BaseUnsortedModel
     */
    public function setCategory($category)
    {
        $this->category = BaseUnsortedModel::CATEGORY_CODE_FORMS;

        return $this;
    }

    /**
     * @return null|UnsortedMetadataInterface
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * @param UnsortedMetadataInterface $metadata
     *
     * @return BaseUnsortedModel
     * @throws BadTypeException
     */
    public function setMetadata(UnsortedMetadataInterface $metadata)
    {
        if (!($metadata instanceof FormsMetadata)) {
            throw new BadTypeException('metadata should be instance of FormsMetadata');
        }
        $this->metadata = $metadata;

        return $this;
    }
}

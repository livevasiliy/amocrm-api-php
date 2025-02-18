<?php

namespace AmoCRM\Collections;

use AmoCRM\Collections\Traits\EntityApiTrait;
use AmoCRM\Models\SourceModel;

/**
 * Class SourcesCollection
 *
 * @package AmoCRM\Collections
 *
 * @method null|SourceModel current()
 * @method null|SourceModel last()
 * @method null|SourceModel first()
 * @method null|SourceModel offsetGet($offset)
 * @method SourcesCollection offsetSet($offset, SourceModel $value)
 * @method SourcesCollection prepend(SourceModel $value)
 * @method SourcesCollection add(SourceModel $value)
 * @method null|SourceModel getBy($key, $value)
 */
class SourcesCollection extends BaseApiCollection
{
    use EntityApiTrait;

    const ITEM_CLASS = SourceModel::class;
}

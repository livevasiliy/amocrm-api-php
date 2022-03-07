<?php

namespace AmoCRM\Collections;

/**
 * Class NullTagsCollection
 *
 * @package AmoCRM\Collections
 */
class NullTagsCollection extends TagsCollection
{
    /**
     * @return null|array
     */
    public function toApi()
    {
        return null;
    }

    /**
     * @return null|array
     */
    public function toEntityApi()
    {
        return null;
    }
}

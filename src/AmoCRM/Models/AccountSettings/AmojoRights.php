<?php

namespace AmoCRM\Models\AccountSettings;

use Illuminate\Contracts\Support\Arrayable;

class AmojoRights implements Arrayable
{
    /**
     * @var bool
     */
    protected $canDirect;

    /**
     * @var bool
     */
    protected $canCreateGroups;

    /**
     * @param  bool  $canDirect
     * @param  bool  $canCreateGroups
     */
    public function __construct(
        $canDirect,
        $canCreateGroups
    ) {
        $this->canDirect = $canDirect;
        $this->canCreateGroups = $canCreateGroups;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'can_direct' => $this->getIsCanDirect(),
            'can_create_groups' => $this->getIsCanCreateGroups(),
        ];
    }

    /**
     * @return bool
     */
    public function getIsCanDirect()
    {
        return $this->canDirect;
    }

    /**
     * @return bool
     */
    public function getIsCanCreateGroups()
    {
        return $this->canCreateGroups;
    }
}

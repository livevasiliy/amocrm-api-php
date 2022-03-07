<?php

namespace AmoCRM\Models\AccountSettings;

use Illuminate\Contracts\Support\Arrayable;

class InvoicesSettings implements Arrayable
{
    /**
     * @var string|null
     */
    protected $lang;

    /**
     * @param  string|null  $lang
     */
    public function __construct($lang)
    {
        $this->lang = $lang;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'lang' => $this->getLang(),
        ];
    }

    /**
     * @return string|null
     */
    public function getLang()
    {
        return $this->lang;
    }
}

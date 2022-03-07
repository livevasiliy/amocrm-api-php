<?php

namespace AmoCRM\Models\Unsorted;

use Illuminate\Contracts\Support\Arrayable;

class UnsortedSummaryModel implements Arrayable
{
    /**
     * @var int
     */
    protected $total;

    /**
     * @var int
     */
    protected $accepted;

    /**
     * @var int
     */
    protected $declined;

    /**
     * @var int
     */
    protected $averageSortTime;

    /**
     * @var array
     */
    protected $categories;

    /**
     * @param array $summary
     * @return self
     */
    public static function fromArray(array $summary)
    {
        $model = new self();

        $model->setTotal($summary['total'])
            ->setAccepted($summary['accepted'])
            ->setDeclined($summary['declined'])
            ->setAverageSortTime($summary['average_sort_time'])
            ->setCategories((array)$summary['categories']);

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'total' => $this->getTotal(),
            'accepted' => $this->getAccepted(),
            'declined' => $this->getDeclined(),
            'average_sort_time' => $this->getAverageSortTime(),
            'categories' => $this->getCategories(),
        ];
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param int $total
     * @return UnsortedSummaryModel
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @return int
     */
    public function getAccepted()
    {
        return $this->accepted;
    }

    /**
     * @param int $accepted
     * @return UnsortedSummaryModel
     */
    public function setAccepted($accepted)
    {
        $this->accepted = $accepted;

        return $this;
    }

    /**
     * @return int
     */
    public function getDeclined()
    {
        return $this->declined;
    }

    /**
     * @param int $declined
     * @return UnsortedSummaryModel
     */
    public function setDeclined($declined)
    {
        $this->declined = $declined;

        return $this;
    }

    /**
     * @return int
     */
    public function getAverageSortTime()
    {
        return $this->averageSortTime;
    }

    /**
     * @param int $averageSortTime
     * @return UnsortedSummaryModel
     */
    public function setAverageSortTime($averageSortTime)
    {
        $this->averageSortTime = $averageSortTime;

        return $this;
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param array $categories
     * @return UnsortedSummaryModel
     */
    public function setCategories(array $categories)
    {
        $this->categories = $categories;

        return $this;
    }
}

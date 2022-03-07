<?php

namespace AmoCRM\Models\NoteType;

use AmoCRM\Models\Factories\NoteFactory;
use AmoCRM\Models\NoteModel;

class GeolocationNote extends NoteModel
{
    protected $modelClass = GeolocationNote::class;

    /**
     * @var null|string
     */
    protected $address;

    /**
     * @var null|string
     */
    protected $longitude;

    /**
     * @var null|string
     */
    protected $latitude;

    /**
     * @var null|string
     */
    protected $text;

    public function getNoteType()
    {
        return NoteFactory::NOTE_TYPE_CODE_GEOLOCATION;
    }

    /**
     * @param array $note
     *
     * @return NoteModel
     */
    public function fromArray(array $note)
    {
        $model = parent::fromArray($note);

        if (isset($note['params']['address'])) {
            $model->setAddress($note['params']['address']);
        }

        if (isset($note['params']['text'])) {
            $model->setText($note['params']['text']);
        }

        if (isset($note['params']['latitude'])) {
            $model->setLatitude($note['params']['latitude']);
        }

        if (isset($note['params']['longitude'])) {
            $model->setLongitude($note['params']['longitude']);
        }

        return $model;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        $result = parent::toArray();

        $result['params']['address'] = $this->getAddress();
        $result['params']['text'] = $this->getText();
        $result['params']['latitude'] = $this->getLatitude();
        $result['params']['longitude'] = $this->getLongitude();

        return $result;
    }

    /**
     * @param string|null $requestId
     * @return array
     */
    public function toApi($requestId = "0")
    {
        $result = parent::toApi($requestId);

        $result['params']['address'] = $this->getAddress();
        $result['params']['text'] = $this->getText();
        $result['params']['latitude'] = $this->getLatitude();
        $result['params']['longitude'] = $this->getLongitude();

        return $result;
    }

    /**
     * @return string|null
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     * @return GeolocationNote
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param string|null $longitude
     * @return GeolocationNote
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param string|null $latitude
     * @return GeolocationNote
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string|null $text
     * @return GeolocationNote
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }
}

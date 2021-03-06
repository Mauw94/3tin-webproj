<?php

namespace model;


class Locatie implements \JsonSerializable
{
    private $id;
    private $naam;

    /**
     * locatie constructor.
     * @param $id
     * @param $naam
     */
    public function __construct($id, $naam)
    {
        $this->id = $id;
        $this->naam = $naam;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNaam()
    {
        return $this->naam;
    }

    /**
     * @param mixed $naam
     */
    public function setNaam($naam)
    {
        $this->naam = $naam;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'naam' => $this->naam
        ];
    }

}
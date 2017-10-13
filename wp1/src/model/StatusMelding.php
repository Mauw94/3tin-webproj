<?php

namespace model;


class StatusMelding implements \JsonSerializable
{
    private $id;
    private $locatieId;
    private $status;
    private $datum;

    /**
     * statusMelding constructor.
     * @param $id
     * @param $locatieId
     * @param $status
     * @param $datum
     */
    public function __construct($id, $locatieId, $status, $datum)
    {
        $this->id = $id;
        $this->locatieId = $locatieId;
        $this->status = $status;
        $this->datum = $datum;
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
    public function getLocatieId()
    {
        return $this->locatieId;
    }

    /**
     * @param mixed $locatieId
     */
    public function setLocatieId($locatieId)
    {
        $this->locatieId = $locatieId;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * @param mixed $datum
     */
    public function setDatum($datum)
    {
        $this->datum = $datum;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return[
            'id'=>$this->id,
            'locatieid'=>$this->locatieId,
            'status'=>$this->status,
            'datum'=>$this->datum
        ];
    }
}
<?php

namespace model;


class Statusmelding
{
    private $id;
    private $locatieId;
    private $status;
    private $datum;

    /**
     * statusmelding constructor.
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

}
<?php

namespace model;


class probleemmelding
{
    private $id;
    private $locatieId;
    private $probleem;
    private $datumAfgehandeld;

    /**
     * probleemmelding constructor.
     * @param $id
     * @param $locatieId
     * @param $probleem
     * @param $datumAfgehandeld
     */
    public function __construct($id, $locatieId, $probleem, $datumAfgehandeld)
    {
        $this->id = $id;
        $this->locatieId = $locatieId;
        $this->probleem = $probleem;
        $this->datumAfgehandeld = $datumAfgehandeld;
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
    public function getProbleem()
    {
        return $this->probleem;
    }

    /**
     * @param mixed $probleem
     */
    public function setProbleem($probleem)
    {
        $this->probleem = $probleem;
    }

    /**
     * @return mixed
     */
    public function getDatumAfgehandeld()
    {
        return $this->datumAfgehandeld;
    }

    /**
     * @param mixed $datumAfgehandeld
     */
    public function setDatumAfgehandeld($datumAfgehandeld)
    {
        $this->datumAfgehandeld = $datumAfgehandeld;
    }

}
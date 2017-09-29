<?php

namespace model;


class ProbleemMelding
{
    private $id;
    private $locatieId;
    private $probleem;
    private $datum;
    private $afgehandeld;


    /**
     * probleemMelding constructor.
     * @param $id
     * @param $locatieId
     * @param $probleem
     * @param $datum
     * @param $afgehandeld
     */
    public function __construct($id, $locatieId, $probleem, $datum, $afgehandeld)
    {
        $this->id = $id;
        $this->locatieId = $locatieId;
        $this->probleem = $probleem;
        $this->datum = $datum;
        $this->afgehandeld=$afgehandeld;
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
     * @return mixed
     */
    public function getAfgehandeld()
    {
        return $this->afgehandeld;
    }

    /**
     * @param mixed $afgehandeld
     */
    public function setAfgehandeld($afgehandeld)
    {
        $this->afgehandeld = $afgehandeld;
    }
}
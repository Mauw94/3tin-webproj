<?php

namespace model;


class ProbleemMelding implements \JsonSerializable
{
    private $id;
    private $locatieid;
    private $probleem;
    private $datum;
    private $afgehandeld;
    private $updownvote;
    private $userId;

    /**
     * ProbleemMelding constructor.
     * @param $id
     * @param $locatieid
     * @param $probleem
     * @param $datum
     * @param $afgehandeld
     * @param $updownvote
     */
    public function __construct($id, $locatieid, $probleem, $datum, $afgehandeld, $updownvote, $userId)
    {
        $this->id = $id;
        $this->locatieid = $locatieid;
        $this->probleem = $probleem;
        $this->datum = $datum;
        $this->afgehandeld = $afgehandeld;
        $this->updownvote = $updownvote;
        $this->userId = $userId;
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
    public function getLocatieid()
    {
        return $this->locatieid;
    }

    /**
     * @param mixed $locatieid
     */
    public function setLocatieid($locatieid)
    {
        $this->locatieid = $locatieid;
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

    /**
     * @return mixed
     */
    public function getUpdownvote()
    {
        return $this->updownvote;
    }

    /**
     * @param mixed $updownvote
     */
    public function setUpdownvote($updownvote)
    {
        $this->updownvote = $updownvote;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'locatieid' => $this->locatieid,
            'probleem' => $this->probleem,
            'datum' => $this->datum,
            'afgehandeld' => $this->afgehandeld,
            'updownvote' => $this->updownvote,
            'userid' => $this->userId
        ];
    }
}
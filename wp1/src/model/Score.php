<?php
/**
 * Created by PhpStorm.
 * User: bramV
 * Date: 29/09/2017
 * Time: 10:36
 */

namespace model;


class Score
{
    private $id;
    private $idprobleemmelding;
    private $aantalscores;
    private $totalescore;

    /**
     * Score constructor.
     * @param $id
     * @param $idprobleemmelding
     * @param $aantalscores
     * @param $totalescore
     */
    public function __construct($id, $idprobleemmelding, $aantalscores, $totalescore)
    {
        $this->id = $id;
        $this->idprobleemmelding = $idprobleemmelding;
        $this->aantalscores = $aantalscores;
        $this->totalescore = $totalescore;
    }


    /**
     * @return mixed
     */
    public function getIdprobleemmelding()
    {
        return $this->idprobleemmelding;
    }

    /**
     * @param mixed $idprobleemmelding
     */
    public function setIdprobleemmelding($idprobleemmelding)
    {
        $this->idprobleemmelding = $idprobleemmelding;
    }

    /**
     * @return mixed
     */
    public function getAantalscores()
    {
        return $this->aantalscores;
    }

    /**
     * @param mixed $aantalscores
     */
    public function setAantalscores($aantalscores)
    {
        $this->aantalscores = $aantalscores;
    }

    /**
     * @return mixed
     */
    public function getTotalescore()
    {
        return $this->totalescore;
    }

    /**
     * @param mixed $totalescore
     */
    public function setTotalescore($totalescore)
    {
        $this->totalescore = $totalescore;
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



}
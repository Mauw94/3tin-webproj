<?php
/**
 * Created by PhpStorm.
 * User: bramV
 * Date: 29/09/2017
 * Time: 10:36
 */

namespace model;


class Score implements \JsonSerializable
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
     * @return mixed
     */
    public function getGemscores()
    {
        return round($this->totalescore/$this->aantalscores,2);
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


    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'idprobleemmelding' => $this->idprobleemmelding,
            'aantalscores'=>$this->aantalscores,
            'totalescore' => $this->totalescore
        ];
    }
}
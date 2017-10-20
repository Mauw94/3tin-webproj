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
    private $idProbleemMelding;
    private $aantalScores;
    private $totaleScore;

    /**
     * Score constructor.
     * @param $id
     * @param $idProbleemMelding
     * @param $aantalScores
     * @param $totaleScore
     */
    public function __construct($id, $idProbleemMelding, $aantalScores, $totaleScore)
    {
        $this->id = $id;
        $this->idProbleemMelding = $idProbleemMelding;
        $this->aantalScores = $aantalScores;
        $this->totaleScore = $totaleScore;
    }


    /**
     * @return mixed
     */
    public function getIdProbleemMelding()
    {
        return $this->idProbleemMelding;
    }

    /**
     * @param mixed $idProbleemMelding
     */
    public function setIdProbleemMelding($idProbleemMelding)
    {
        $this->idProbleemMelding = $idProbleemMelding;
    }

    /**
     * @return mixed
     */
    public function getAantalScores()
    {
        return $this->aantalScores;
    }
    /**
     * @return mixed
     */
    public function getGemscores()
    {
        return round($this->totaleScore/$this->aantalScores,2);
    }

    /**
     * @param mixed $aantalScores
     */
    public function setAantalScores($aantalScores)
    {
        $this->aantalScores = $aantalScores;
    }

    /**
     * @return mixed
     */
    public function getTotaleScore()
    {
        return $this->totaleScore;
    }

    /**
     * @param mixed $totaleScore
     */
    public function setTotaleScore($totaleScore)
    {
        $this->totaleScore = $totaleScore;
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
            'idprobleemmelding' => $this->idProbleemMelding,
            'aantalscores'=>$this->aantalScores,
            'totalescore' => $this->totaleScore
        ];
    }
}
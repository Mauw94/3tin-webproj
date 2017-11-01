<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Score
 *
 * @ORM\Table(name="score")
 * @ORM\Entity
 */
class Score
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idprobleemmelding", type="integer", nullable=false)
     */
    private $idprobleemmelding;

    /**
     * @var integer
     *
     * @ORM\Column(name="aantalscores", type="integer", nullable=false)
     */
    private $aantalscores;

    /**
     * @var integer
     *
     * @ORM\Column(name="totalescore", type="integer", nullable=false)
     */
    private $totalescore;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Score constructor.
     * @param int $idprobleemmelding
     * @param int $aantalscores
     * @param int $totalescore
     */
    public function __construct($idprobleemmelding, $aantalscores, $totalescore)
    {
        $this->idprobleemmelding = $idprobleemmelding;
        $this->aantalscores = $aantalscores;
        $this->totalescore = $totalescore;
    }

    /**
     * @return int
     */
    public function getIdprobleemmelding(): int
    {
        return $this->idprobleemmelding;
    }

    /**
     * @param int $idprobleemmelding
     */
    public function setIdprobleemmelding(int $idprobleemmelding)
    {
        $this->idprobleemmelding = $idprobleemmelding;
    }

    /**
     * @return int
     */
    public function getAantalscores(): int
    {
        return $this->aantalscores;
    }

    /**
     * @param int $aantalscores
     */
    public function setAantalscores(int $aantalscores)
    {
        $this->aantalscores = $aantalscores;
    }

    /**
     * @return int
     */
    public function getTotalescore(): int
    {
        return $this->totalescore;
    }

    /**
     * @param int $totalescore
     */
    public function setTotalescore(int $totalescore)
    {
        $this->totalescore = $totalescore;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }


}


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


}


<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Probleemmelding
 *
 * @ORM\Table(name="probleemmelding", uniqueConstraints={@ORM\UniqueConstraint(name="locatieid", columns={"locatieid"})})
 * @ORM\Entity
 */
class Probleemmelding
{
    /**
     * @var integer
     *
     * @ORM\Column(name="locatieid", type="integer", nullable=false)
     */
    private $locatieid;

    /**
     * @var string
     *
     * @ORM\Column(name="probleem", type="string", length=45, nullable=false)
     */
    private $probleem;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datum", type="date", nullable=false)
     */
    private $datum;

    /**
     * @var boolean
     *
     * @ORM\Column(name="afgehandeld", type="boolean", nullable=false)
     */
    private $afgehandeld;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}


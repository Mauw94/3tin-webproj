<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statusmelding
 *
 * @ORM\Table(name="statusmelding")
 * @ORM\Entity
 */
class Statusmelding
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
     * @ORM\Column(name="status", type="string", length=45, nullable=false)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datum", type="date", nullable=false)
     */
    private $datum;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @return int
     */
    public function getLocatieid(): int
    {
        return $this->locatieid;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return \DateTime
     */
    public function getDatum(): \DateTime
    {
        return $this->datum;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }



}


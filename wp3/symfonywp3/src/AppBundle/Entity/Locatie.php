<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Locatie
 *
 * @ORM\Table(name="locatie")
 * @ORM\Entity
 */
class Locatie
{
    /**
     * @var string
     *
     * @ORM\Column(name="naam", type="string", length=50, nullable=false)
     */
    private $naam;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}


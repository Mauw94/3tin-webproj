<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Probleemmelding
 *
 * @ORM\Table(name="probleemmelding")
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
     * @ORM\Column(name="updownvote", type="integer")
     */
    private $updownvote;

    /**
     * @var integer
     *
     * @ORM\Column(name="userid", type="integer")
     */
    private $userid;

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
    private $score;

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param mixed $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }
    public function getLocatieid()
    {
        return $this->locatieid;
    }

    /**
     * @return string
     */
    public function getProbleem()
    {
        return $this->probleem;
    }

    /**
     * @return \DateTime
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * @return bool
     */
    public function isAfgehandeld()
    {
        return $this->afgehandeld;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $locatieid
     */
    public function setLocatieid(int $locatieid)
    {
        $this->locatieid = $locatieid;
    }

    /**
     * @param string $probleem
     */
    public function setProbleem(string $probleem)
    {
        $this->probleem = $probleem;
    }

    /**
     * @param \DateTime $datum
     */
    public function setDatum(\DateTime $datum)
    {
        $this->datum = $datum;
    }

    /**
     * @param bool $afgehandeld
     */
    public function setAfgehandeld(bool $afgehandeld)
    {
        $this->afgehandeld = $afgehandeld;
    }

    /**
     * @param int $updownvote
     */
    public function setUpdownvote(int $updownvote)
    {
        $this->updownvote = $updownvote;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getUserid(): int
    {
        return $this->userid;
    }

    /**
     * @param int $userid
     */
    public function setUserid(int $userid)
    {
        $this->userid = $userid;
    }


}


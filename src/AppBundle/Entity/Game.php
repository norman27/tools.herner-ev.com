<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="b2n61_hockeymanager_schedule")
 */
class Game {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /** @ORM\Column(type="integer") */
    public $catid;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Club")
     * @ORM\JoinColumn(name="hometeam", referencedColumnName="id")
     */
    public $hometeam;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Club")
     * @ORM\JoinColumn(name="awayteam", referencedColumnName="id")
     */
    public $awayteam;

    /** @ORM\Column(type="integer") */
    public $homescore;

    /** @ORM\Column(type="integer") */
    public $awayscore;

    /** @ORM\Column(type="string") */
    public $gamedate;

    /** @ORM\Column(type="string") */
    public $gametime;

    /** @ORM\Column(type="integer") */
    public $state;
}
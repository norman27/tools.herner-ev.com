<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="b2n61_hockeymanager_table")
 */
class Table {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /** @ORM\Column(type="integer") */
    public $catid;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Hockey\Club")
     * @ORM\JoinColumn(name="club_id", referencedColumnName="id")
     */
    public $club;

    /** @ORM\Column(type="integer") */
    public $gamesWon;

    /** @ORM\Column(type="integer") */
    public $gamesWonOvertime;

    /** @ORM\Column(type="integer") */
    public $gamesWonPenalty;

    /** @ORM\Column(type="integer") */
    public $gamesLost;

    /** @ORM\Column(type="integer") */
    public $gamesLostOvertime;

    /** @ORM\Column(type="integer") */
    public $gamesLostPenalty;

    /** @ORM\Column(type="integer") */
    public $gamesDraw;

    /** @ORM\Column(type="integer") */
    public $goalsFor;

    /** @ORM\Column(type="integer") */
    public $goalsAgainst;

    /** @ORM\Column(type="integer") */
    public $points;

    /** @ORM\Column(type="integer") */
    public $state;
}
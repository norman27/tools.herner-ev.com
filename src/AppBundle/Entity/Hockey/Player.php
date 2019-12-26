<?php

namespace AppBundle\Entity\Hockey;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="b2n61_hockeymanager_team")
 */
class Player {
    const GOALIE = 'GOALIE';
    const DEFENDER = 'DEFENDER';
    const FORWARD = 'FORWARD';
    const COACH = 'COACH';

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /** @ORM\Column(type="integer") */
    public $catid;

    /** @ORM\Column(type="integer") */
    public $number;

    /** @ORM\Column(type="string") */
    public $name;

    /** @ORM\Column(type="string") */
    public $position;

    /** @ORM\Column(type="string") */
    public $nation;

    /** @ORM\Column(type="string") */
    public $image;

    /** @ORM\Column(type="string") */
    public $imageAlternative;

    /** @ORM\Column(type="integer") */
    public $state;
}
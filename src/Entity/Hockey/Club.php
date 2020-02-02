<?php

namespace App\Entity\Hockey;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="b2n61_hockeymanager_clubs")
 */
class Club {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /** @ORM\Column(type="string", length=255) */
    public $name;

    /** @ORM\Column(type="string", length=255) */
    public $logo;

    /** @ORM\Column(type="integer") */
    public $state;
}
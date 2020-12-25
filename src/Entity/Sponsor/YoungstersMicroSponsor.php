<?php

namespace App\Entity\Sponsor;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="app_youngsters_microsponsors")
 */
class YoungstersMicroSponsor {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\Column(type="string")
     */
    public $name;

    /**
     * @ORM\Column(name="is_blocked", type="boolean", options={"default":"0"})
     */
    public $isBlocked;
}
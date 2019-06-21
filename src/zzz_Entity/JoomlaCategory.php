<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="b2n61_categories")
 */
class JoomlaCategory {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /** @ORM\Column(type="string", length=255) */
    public $title;

    /** @ORM\Column(type="string", length=50) */
    public $extension;

    /** @ORM\Column(type="smallint") */
    public $published;

    /** @ORM\Column(type="integer") */
    public $level;
}
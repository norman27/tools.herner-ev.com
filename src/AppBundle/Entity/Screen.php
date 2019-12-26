<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="app_screens")
 * @ORM\HasLifecycleCallbacks
 */
class Screen
{
    const IS_ACTIVE = 1;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /** @ORM\Column(type="string", length=100) */
    public $name;

    /** @ORM\Column(type="string", length=100) */
    public $screenType;

    /** @ORM\Column(type="array") */
    public $config = 'a:0:{}';

    /** @ORM\Column(type="smallint") */
    public $active;

    /** @ORM\Column(type="datetime") */
    public $lastChange;

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function onPersistSetLastChange() {
        $this->lastChange = new \DateTime();
    }

    /**
     * @return bool
     */
    public function isEnrichable(): bool {
        switch ($this->screenType) {
            case 'table':
                return true;
        }

        return false;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getConfig(string $key) {
        if (array_key_exists($key, $this->config)) {
            return $this->config[$key];
        }

        return null;
    }
}
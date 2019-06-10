<?php

namespace AppBundle\Entity\Screen;

class Audio
{
    /**
     * @var string The url of the file to play
     */
    public $src;

    /**
     * @var int The volume from 0-100
     */
    public $volume;

    /**
     * @var int The timestamp when this was set
     */
    public $lastChange;

    /**
     * @param $src
     * @param int $volume
     * @param null|int $lastChange
     */
    public function __construct($src = '', $volume = 80, $lastChange = null)
    {
        if ($lastChange === null)
        {
            $lastChange = time();
        }

        $this->src = $src;
        $this->volume = $volume;
        $this->lastChange = $lastChange;
    }
}
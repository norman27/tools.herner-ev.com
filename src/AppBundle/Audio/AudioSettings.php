<?php

namespace AppBundle\Audio;

final class AudioSettings
{
    /**
     * @var string The filename of the running track
     */
    public $track;

    /**
     * @var int The volume from 0-100
     */
    public $volume;

    /**
     * @var int The timestamp when this was set
     */
    public $lastChange;

    /**
     * @param string $track
     * @param int $volume
     * @param null|int $lastChange
     */
    public function __construct($track = '', $volume = 80, $lastChange = null)
    {
        if ($lastChange === null)
        {
            $lastChange = time();
        }

        $this->track = $track;
        $this->volume = $volume;
        $this->lastChange = $lastChange;
    }
}
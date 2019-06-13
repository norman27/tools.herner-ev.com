<?php

namespace AppBundle\Audio;

final class AudioTrack
{
    /**
     * @var string
     */
    public $track;

    /**
     * @var int
     */
    public $duration;

    /**
     * @param string $track
     * @param int $duration
     */
    public function __construct(string $track, int $duration)
    {
        $this->track = $track;
        $this->duration = $duration;
    }
}
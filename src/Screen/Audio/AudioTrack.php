<?php

namespace App\Screen\Audio;

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

    public function __construct(string $track, int $duration)
    {
        $this->track = $track;
        $this->duration = $duration;
    }
}
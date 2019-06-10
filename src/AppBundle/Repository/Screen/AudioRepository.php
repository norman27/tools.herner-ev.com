<?php

namespace AppBundle\Repository\Screen;

use Symfony\Component\Cache\Adapter\AdapterInterface;
use AppBundle\Entity\Screen\Audio;

class AudioRepository
{
    const CACHE_KEY = 'screen.audio.repository';

    /** @var AdapterInterface */
    private $cache;

    public function __construct(AdapterInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Adjusts the track and changes the lastChange property
     *
     * @param string $track
     * @return Audio
     */
    public function setTrack($track)
    {
        $item = $this->cache->getItem(self::CACHE_KEY);

        /** @var Audio $audio */
        $audio = $item->get();
        $audio->track = $track;
        $audio->lastChange = time();

        $item->set($audio);
        $this->cache->save($item);

        return $audio;
    }

    /**
     * Only adjusts the volume without changing the lastChange timestamp of audio settings
     *
     * @param int $volume
     * @return Audio
     */
    public function setVolume($volume)
    {
        $item = $this->cache->getItem(self::CACHE_KEY);

        /** @var Audio $audio */
        $audio = $item->get();
        $audio->volume = $volume;

        $item->set($audio);
        $this->cache->save($item);

        return $audio;
    }

    /**
     * @return Audio
     */
    public function get()
    {
        $audio = $this->cache->getItem(self::CACHE_KEY);
        if ($audio->isHit())
        {
            return $audio->get();
        }
        return new Audio();
    }
}
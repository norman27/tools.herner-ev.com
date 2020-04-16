<?php

namespace App\Screen\Audio;

use Psr\Cache\CacheItemPoolInterface;
use falahati\PHPMP3\MpegAudio;
use Psr\Cache\InvalidArgumentException;

final class AudioRepository
{
    const CACHE_KEY = 'screen.audio.repository';

    /** @var CacheItemPoolInterface */
    private $cache;

    public function __construct(CacheItemPoolInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @return AudioTrack[]
     */
    public function getAvailableTracks()
    {
        // @TODO fill with real data
        // @TODO cache metadata
        $files = ['hockey-organ-1.mp3'];
        $tracks = [];
        foreach ($files as $file) {
            $tracks[$file] = new AudioTrack(
                $file,
                (int) MpegAudio::fromFile(realpath(__DIR__ . '/../../../public/audio/' . $file))->getTotalDuration()
            );
        }
        ksort($tracks);

        return array_values($tracks);
    }

    /**
     * Adjusts the track and changes the lastChange property
     *
     * @param string $track
     * @return AudioSettings
     * @throws InvalidArgumentException
     */
    public function setTrack($track)
    {
        $item = $this->cache->getItem(self::CACHE_KEY);

        /** @var AudioSettings $audio */
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
     * @return AudioSettings
     * @throws InvalidArgumentException
     */
    public function setVolume($volume)
    {
        $item = $this->cache->getItem(self::CACHE_KEY);

        /** @var AudioSettings $audio */
        $audio = $item->get();
        $audio->volume = $volume;

        $item->set($audio);
        $this->cache->save($item);

        return $audio;
    }

    /**
     * @return AudioSettings
     * @throws InvalidArgumentException
     */
    public function get()
    {
        $item = $this->cache->getItem(self::CACHE_KEY);
        if ($item->isHit())
        {
            return $item->get();
        }

        // if no cache present, create one
        $audio = new AudioSettings();
        $item->set($audio);
        $this->cache->save($item);
        return $audio;
    }
}
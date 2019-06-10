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
     * @param string $src
     * @param int $volume
     */
    public function set($src, $volume)
    {
        $audio = new Audio($src, $volume);
        $item = $this->cache->getItem(self::CACHE_KEY);
        $item->set($audio);
        $this->cache->save($item);
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
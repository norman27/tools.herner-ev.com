<?php

namespace AppBundle\Repository;

use Symfony\Component\Cache\Simple\FilesystemCache;

class EffectsRepository
{
    const CACHE_KEY = 'screen.effects';

    /** @var FilesystemCache */
    private $cache;

    public function __construct()
    {
        $this->cache = new FilesystemCache();
    }

    /**
     * @param string $effect
     * @param string $addData
     */
    public function setEffect($effect, $addData)
    {
        $this->cache->set(
            self::CACHE_KEY,
            [
                0 => $effect,
                1 => $addData,
                'timestamp' => \date('U')
            ]
        );
    }

    /**
     * @return array
     */
    public function getEffect()
    {
        return $this->cache->get(self::CACHE_KEY, '');
    }

    /**
     * @return bool
     */
    public function hasEffect()
    {
        return ($this->cache->get(self::CACHE_KEY, '') !== '');
    }
}
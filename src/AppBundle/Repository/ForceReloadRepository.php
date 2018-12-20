<?php

namespace AppBundle\Repository;

use Symfony\Component\Cache\Simple\FilesystemCache;

class ForceReloadRepository {
    const CACHE_KEY = 'screen.force_reload';

    /** @var FilesystemCache */
    private $cache;

    public function __construct() {
        $this->cache = new FilesystemCache();
    }

    /**
     * @return bool
     */
    public function isForceReload() {
        return $this->cache->get(self::CACHE_KEY, false);
    }

    /**
     * @param bool $force
     */
    public function setForceReload($force) {
        $this->cache->set(self::CACHE_KEY, $force);
    }
}
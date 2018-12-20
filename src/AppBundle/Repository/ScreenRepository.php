<?php

namespace AppBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Registry;
use AppBundle\Entity\Screen;
use Symfony\Component\Cache\Simple\FilesystemCache;

class ScreenRepository {
    const CACHE_KEY = 'screen.active_category';

    const CATEGORY_ERSTE = 0;
    const CATEGORY_NACHWUCHS = 1;

    /** @var Registry */
    private $doctrine;

    /** @var FilesystemCache */
    private $cache;

    /**
     * @param Registry $doctrine
     */
    public function __construct(Registry $doctrine) {
        $this->doctrine = $doctrine;
        $this->cache = new FilesystemCache();
    }

    /**
     * @return Screen[]
     */
    public function getAllForActiveCategory() {
        return $this->filterGet(['category' => $this->getCategory()]);
    }

    /**
     * @param int $id
     * @return Screen
     */
    public function getById($id) {
        return current($this->filterGet(['id' => $id]));
    }

    /**
     * @param array $filters
     * @return Screen[]
     */
    private function filterGet(array $filters) {
        $repository = $this->doctrine->getRepository(Screen::class);
        return $repository->findBy($filters);
    }

    /**
     * @return int
     */
    public function getCategory() {
        return $this->cache->get(self::CACHE_KEY, self::CATEGORY_ERSTE);
    }

    /**
     * @return string
     */
    public function getCategoryTranslated() {
        if ($this->getCategory() === self::CATEGORY_NACHWUCHS) {
            return 'Nachwuchs';
        }

        return 'Erste Mannschaft';
    }

    /**
     * @param int $category
     */
    public function setCategory($category) {
        $this->cache->set(self::CACHE_KEY, $category);
    }
}
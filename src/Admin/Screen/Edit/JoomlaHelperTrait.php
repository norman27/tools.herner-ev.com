<?php

namespace App\Admin\Screen\Edit;

use App\Entity\Joomla\Banner;
use App\Entity\Joomla\Category;
use App\Entity\Hockey\Club;
use Doctrine\Common\Persistence\ManagerRegistry;

trait JoomlaHelperTrait
{
    /**
     * @var ManagerRegistry
     */
    private $managerRegistry;

    /**
     * @param ManagerRegistry $managerRegistry
     */
    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    /**
     * @return Banner[]
     */
    private function getBanners()
    {
        /** @var Banner[] $banners */
        $joomlaBanners = $this->managerRegistry->getRepository(Banner::class)->findBy([
            'state' => 1
        ]);

        $banners = [];
        foreach ($joomlaBanners as $banner) {
            $banners[$banner->name] = $banner->params["imageurl"];
        }

        ksort($banners);

        return $banners;
    }

    /**
     * @param string $extension
     * @return array
     */
    private function getCategories(string $extension): array
    {
        /** @var Category[] $cats */
        $joomlaCategories = $this->managerRegistry->getRepository(Category::class)->findBy([
            'extension' => $extension,
            'published' => 1,
            'level' => 2
        ]);

        $categories = [];
        foreach ($joomlaCategories as $joomlaCategory)
        {
            $categories[$joomlaCategory->title] = $joomlaCategory->id;
        }

        ksort($categories);

        return $categories;
    }

    /**
     * @return Club[]
     */
    private function getClubs()
    {
        /** @var Club[] $clubs */
        $joomlaClubs = $this->managerRegistry->getRepository(Club::class)->findBy([
            'state' => 1
        ]);

        $clubs = [];
        foreach ($joomlaClubs as $club)
        {
            $clubs[$club->name] = $club->id;
        }

        ksort($clubs);

        return $clubs;
    }
}
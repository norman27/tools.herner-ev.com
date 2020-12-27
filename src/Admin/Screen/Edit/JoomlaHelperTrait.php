<?php declare(strict_types=1);

namespace App\Admin\Screen\Edit;

use App\Entity\Joomla\Banner;
use App\Entity\Joomla\Category;
use App\Entity\Hockey\Club;
use Doctrine\Bundle\DoctrineBundle\Registry;

trait JoomlaHelperTrait
{
    private Registry $registry;

    /**
     * @param Registry $registry
     */
    public function __construct(Registry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @return Banner[]
     */
    private function getBanners(): array
    {
        /** @var Banner[] $banners */
        $joomlaBanners = $this->registry->getRepository(Banner::class)->findBy([
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
        $joomlaCategories = $this->registry->getRepository(Category::class)->findBy([
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
    private function getClubs(): array
    {
        /** @var Club[] $clubs */
        $joomlaClubs = $this->registry->getRepository(Club::class)->findBy([
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
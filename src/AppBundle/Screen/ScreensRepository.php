<?php

namespace AppBundle\Screen;

use Doctrine\Bundle\DoctrineBundle\Registry;
use AppBundle\Entity\Screen\Screen;

class ScreensRepository
{
    /** @var Registry */
    private $doctrine;

    /**
     * @param Registry $doctrine
     */
    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @return Screen[]
     */
    public function getAll()
    {
        return $this->filterGet([]);
    }

    /**
     * @param int $id
     * @return Screen
     */
    public function getById($id)
    {
        return current($this->filterGet(['id' => $id]));
    }

    /**
     * @param array $filters
     * @return Screen[]
     */
    private function filterGet(array $filters)
    {
        $repository = $this->doctrine->getRepository(Screen::class);
        return $repository->findBy($filters);
    }
}
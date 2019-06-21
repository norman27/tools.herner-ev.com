<?php

namespace AppBundle\Screen;

use AppBundle\Entity\Screen;
use Doctrine\Common\Persistence\ManagerRegistry;

class ScreensRepository
{
    /** @var ManagerRegistry */
    private $doctrine;

    /**
     * @param ManagerRegistry $doctrine
     */
    public function __construct(ManagerRegistry $doctrine)
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
     * @return Screen
     */
    public function getActive()
    {
        return current($this->filterGet(['active' => Screen::IS_ACTIVE], null, 1));
    }

    /**
     * @param int $id
     */
    public function activate(int $id)
    {
        $this->deactivateAll();

        $screen = $this->getById($id);
        $screen->active = Screen::IS_ACTIVE;

        $em = $this->doctrine->getManager();
        $em->persist($screen);
        $em->flush();
    }

    /**
     * Deactivate all screens
     */
    private function deactivateAll()
    {
        $em = $this->doctrine->getManager();
        $query = $em->createQuery('UPDATE AppBundle:Screen s SET s.active = 0');
        $query->execute();
    }

    /**
     * @param array $filters
     * @param array|null $orderBy
     * @param int|null $limit
     * @param int|null $offset
     * @return Screen[]
     */
    private function filterGet(array $filters, array $orderBy = null, int $limit = null, int $offset = null)
    {
        $repository = $this->doctrine->getRepository(Screen::class);
        return $repository->findBy($filters, $orderBy, $limit, $offset);
    }
}
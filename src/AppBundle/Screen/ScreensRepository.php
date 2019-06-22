<?php

namespace AppBundle\Screen;

use AppBundle\Entity\Screen;
use Doctrine\Common\Persistence\ManagerRegistry;

class ScreensRepository
{
    /** @var ManagerRegistry */
    private $managerRegistry;

    /**
     * @param ManagerRegistry $managerRegistry
     */
    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
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
        $this->save($screen);
    }

    public function save(Screen $screen)
    {
        $em = $this->managerRegistry->getManager();
        $em->persist($screen);
        $em->flush();
    }

    /**
     * Deactivate all screens
     */
    private function deactivateAll()
    {
        $em = $this->managerRegistry->getManager();
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
        $repository = $this->managerRegistry->getRepository(Screen::class);
        return $repository->findBy($filters, $orderBy, $limit, $offset);
    }
}